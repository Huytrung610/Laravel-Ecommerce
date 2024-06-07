<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Notifications\StatusNotification;
use Notification;


class Order extends Model
{
    const STATUS_NEW = 'new';
    const STATUS_PROCESS = 'process';
    const STATUS_DELIVERY = 'delivered';
    const STATUS_CANCEL = 'cancel';
    const ORDER_RECEIPT = 1;
    const TYPE = 'order';

    const LIST_ORDER_STATUS = [
        self::STATUS_NEW,
        self::STATUS_PROCESS,
        self::STATUS_DELIVERY,
        self::STATUS_CANCEL
    ];


    protected $fillable = [
        'user_id',
        'order_number',
        'sub_total',
        'quantity',
        'status',
        'total_amount',
        'name',
        'detail_address',
        'phone',
        'email',
        'payment_method',
        'payment_status',
        'gender',
        'remark',
        'delivery_date'
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function cart_info()
    {
        return $this->hasMany('App\Models\Cart', 'order_id', 'id');
    }

    public function getOrderListByUser($user_id){
        return $this->where('user_id', $user_id)->orderBy('id', 'DESC')->get();
    }

    public static function getTotalRevenue(){
        return static::where('payment_status', 'paid')
                    ->sum('total_amount');
    }
    public static function getOrderByTime($month, $year) {
       return self::whereMonth('created_at',$month)
                ->whereYear('created_at', $year)
                ->count();
    }
    public static function getTotalOrders(){
        return self::count();
    }
    public static function getCancelOrders(){
        return self::where('status','cancel')->count();
    }

    public static function revenueByYear($year){
       
        return self::select(
            DB::raw('
                months.month, 
                FORMAT(COALESCE(SUM(orders.total_amount), 0), 0) as monthly_revenue
            ')
        )->from(DB::raw('(
            SELECT 1 AS month
                UNION SELECT 2
                UNION SELECT 3
                UNION SELECT 4
                UNION SELECT 5
                UNION SELECT 6
                UNION SELECT 7
                UNION SELECT 8
                UNION SELECT 9
                UNION SELECT 10
                UNION SELECT 11
                UNION SELECT 12
        ) as months'))->leftJoin('orders', function($join) use ($year){
            $join->on(DB::raw('months.month'), '=', DB::raw('MONTH(orders.created_at)'))
            ->where('orders.payment_status', '=', 'paid')
            ->where(DB::raw('YEAR(orders.created_at)'), '=',$year );
        })->groupBy('months.month')->get();
    }

    public static function revenue7Day(){
        return self::select(DB::raw('
            dates.date,
            FORMAT(COALESCE(SUM(orders.total_amount), 0), 0) as daily_revenue
        '))->from(DB::raw('(
            SELECT CURDATE() - INTERVAL (a.a + (10*b.a) + (100 * c.a)) DAY as date
            FROM (
                SELECT 0 AS a UNION ALL
                SELECT 1 UNION ALL
                SELECT 2 UNION ALL
                SELECT 3 UNION ALL
                SELECT 4 UNION ALL
                SELECT 5 UNION ALL
                SELECT 6 UNION ALL
                SELECT 7 UNION ALL
                SELECT 8 UNION ALL
                SELECT 9 
            ) as a
            CROSS JOIN (
                SELECT 0 AS a UNION ALL
                SELECT 1 UNION ALL
                SELECT 2 UNION ALL
                SELECT 3 UNION ALL
                SELECT 4 UNION ALL
                SELECT 5 UNION ALL
                SELECT 6 UNION ALL
                SELECT 7 UNION ALL
                SELECT 8 UNION ALL
                SELECT 9 
            ) as  b
            CROSS JOIN (
                SELECT 0 AS a UNION ALL
                SELECT 1 UNION ALL
                SELECT 2 UNION ALL
                SELECT 3 UNION ALL
                SELECT 4 UNION ALL
                SELECT 5 UNION ALL
                SELECT 6 UNION ALL
                SELECT 7 UNION ALL
                SELECT 8 UNION ALL
                SELECT 9 
            ) as  c
        ) as dates'))
        ->leftJoin('orders', function($join) {
            $join->on(DB::raw('DATE(orders.created_at)'), '=', DB::raw('dates.date'))
            ->where('orders.payment_status', '=', 'paid');
        })
        ->where(DB::raw('dates.date'), '>=', DB::raw('CURDATE() - INTERVAL 6 DAY'))
        ->groupBy(DB::raw('dates.date'))
        ->orderBy(DB::raw('dates.date'), 'ASC')
        ->get();
    }

    public static function revenueCurrentMonth($currentMonth, $currentYear){
        return self::select(
            DB::raw('DAY(created_at) as day'),
            DB::raw('FORMAT(COALESCE(SUM(orders.total_amount), 0), 0) as daily_revenue')
        )
        ->whereMonth('created_at',$currentMonth)
        ->whereYear('created_at',$currentYear)
        ->groupBy('day')
        ->orderBy('day')
        ->get();
    }


    public static function getTopSellingProductsWithVariants() {
        $orderIds = Order::where('status', 'delivered')->pluck('id')->toArray();
    
        $topProducts = Cart::whereIn('order_id', $orderIds)
            ->select('product_id', DB::raw('SUM(quantity) as total_quantity'), 'code_variant')
            ->groupBy('product_id', 'code_variant')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();
    
        $topSellingProducts = [];
    
        foreach ($topProducts as $product) {
            $productName = '';
            $productModel = Product::find($product->product_id);
    
            if ($product->code_variant) {
                $variant = ProductVariant::where('product_id', $product->product_id)
                                         ->where('code', $product->code_variant)
                                         ->first();
                if ($variant) {
                    $productName = $productModel->title . ' ' . $variant->name;
                }
            } else {
                $productName = $productModel->title;
            }
    
            $topSellingProducts[] = [
                'product_id' => $product->product_id,
                'product_name' => $productName,
                'total_quantity' => $product->total_quantity,
            ];
        }
    
        usort($topSellingProducts, function($a, $b) {
            return $b['total_quantity'] <=> $a['total_quantity'];
        });
    
        return array_slice($topSellingProducts, 0, 5);
    }
    
    protected static function boot()
    {
        parent::boot();
        // send notification to admin when a new order is created
        static::created(function ($order) {
            $users = User::where('role', 'admin')->first();
            $details = [
                'title' => __('New order #'.$order->order_number.' has created'),
                'actionURL' => route('order.show', $order->id),
                'order_id' => $order->id,
                'order_number' => $order->order_number, 
                'type' => self::TYPE,
                'fas' => 'fa-file-alt'
            ];
            Notification::send($users, new StatusNotification($details));
        });

        // send notification to customer when admin updates order status
        static::updated(function ($order) {
            $customer = User::where('id', $order->user_id)->first();
            $statusAttributeIsChanged = !$order->originalIsEquivalent('status');

            if ($statusAttributeIsChanged && !empty($customer)) {
                $detailNotification = [
                    'title' => '',
                    'actionURL' => route('order-detail', $order->id),
                    'order_id' => $order->id,
                    'order_number' => $order->order_number, 
                    'type' => self::TYPE,
                    'fas' => 'fa-file-alt'
                ];
                $order = self::find($order->id);
                if ($order->getAttribute('status') == self::STATUS_PROCESS) {
                    $detailNotification['title'] = __('Your Order '. $order->order_number .' is being shipped');
                    Notification::send($customer, new StatusNotification($detailNotification));
                } elseif ($order->getAttribute('status') == self::STATUS_DELIVERY) {
                    $detailNotification['title'] = __('Your order '. $order->order_number .' has been shipped to you');
                    Notification::send($customer, new StatusNotification($detailNotification));
                } elseif ($order->getAttribute('status') == self::STATUS_CANCEL) {
                    $detailNotification['title'] = __('Your order '. $order->order_number .' has been canceled');
                    Notification::send($customer, new StatusNotification($detailNotification));
                }
            }
        });
    }

    
}
