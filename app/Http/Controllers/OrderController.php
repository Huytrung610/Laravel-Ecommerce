<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Attribute;
use App\Helpers\Backend\ProductHelper;
use App\Models\CustomerAddress;
use \Illuminate\Support\Str;
use \Carbon\Carbon;
use \App\Helpers\Api\DeliveryHelper;
use App\Helpers\Api\CartHelper;
use App\Classes\Vnpay;
use App\Classes\Momo;


class OrderController extends Controller
{
    protected $vnpay;
    protected $momo;
    public function __construct(
        Vnpay $vnpay,
        Momo $momo,
    ){
        $this->vnpay = $vnpay;
        $this->momo = $momo;
    }
    
    public function index(Request $request)
    {
        $orders = Order::orderBy('id', 'DESC');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        if ($request->has('start_date') && !empty($start_date) && $request->has('end_date') && !empty($end_date)) {
            $start_date = Carbon::parse($request->start_date)->startOfDay();
            $end_date = Carbon::parse($request->end_date)->endOfDay();
    
            $orders = $orders->whereBetween('created_at', [$start_date, $end_date]);
        }
    
        $orders = $orders->get();
        $totalAmount = $orders->where('payment_status', '!=', 'payment_failed')->sum('total_amount');
    
        return view('backend.order.index')->with('orders', $orders)
                    ->with('totalAmount', $totalAmount);
    }
    public function store(Request $request)
    {
        try {
            $validate = $this->validate($request, [
                'address_id' => 'required',
            ]);
            if (!$validate) {
                throw new \Exception(__('Something went wrong, the address not found with customer'));
            }
            $currentUserId = auth()->user()->id ?? '';
            $addressId = $request->get('address_id');
            if (empty($currentUserId)) {
                throw new \Exception(__('Not found customer'));
            }
            if (empty(Cart::where('user_id', $currentUserId)->where('order_id', null)->first())) {
                throw new \Exception(__('Cart is empty'));
            }
            $order = new Order();
            $this->checkAvailableToContinueProcess($currentUserId);
            $orderData = $this->prepareDataForOrder($currentUserId, $addressId);
            $response = $this->paymentMethod($request->payment_method, $orderData);
            $order->fill($response['orderData']);
            $status = $order->save();

            if (is_array($response) && isset($response[0]['errorCode']) && $response[0]['errorCode'] == 0) {
                return redirect()->away($response[0]['url']);
            } else {
                session()->forget('cart');
                Cart::where('user_id', $currentUserId)->where('order_id', null)->update(['order_id' => $order->id]);
                $cartHelper = new CartHelper();
                $dataCart = $cartHelper->getAllCartByOrder($response['orderData']);
                if($status){
                   $cartHelper->mail($dataCart);
                }
            }
            // return redirect()->route('checkout.success');
            return view('frontend.pages.checkout-success')->with('dataCart',$dataCart);
        } catch (\Exception $exception) {
            request()->session()->flash('error', $exception->getMessage());
            return back();
        }
    }

    public function paymentMethod($orderMethod, $orderData){
        switch ($orderMethod) {
            case 'vnpay':
                $orderData['payment_method'] = 'vnpay';
                $orderData['payment_status'] = 'unpaid';
                $respone = array(
                    $this->vnpay->payment($orderData),
                    'orderData' => $orderData
                );
                break;
            case 'momo':
                $respone = $this->momo->payment($orderData);
                break;
            case 'cod':
                $orderData['payment_method'] = 'cod'; // to do
                $orderData['payment_status'] = 'Unpaid'; // to do
                $respone = array(
                    'errorCode' => '1',
                    'orderData' => $orderData
                );
                break;
        }
        return $respone;
    }

    public function checkAvailableToContinueProcess($currentUserId, $orderId = null) {
        $productHelper = new ProductHelper();

        $allCartItem = Cart::where('user_id', $currentUserId)->where('order_id', $orderId)->get();
        if ($allCartItem->count() <= 0) {
            throw new \Exception(__('No cart item available'));
        }
        foreach ($allCartItem as $item) {
            $productId = $item->getAttribute('product_id');
            $product = $item->code_variant ? ProductVariant::where('product_id', $productId)
                                            ->where('code',$productHelper->sortVariantId($item->code_variant))
                                            ->first() : Product::where('id', $productId)->first();
            if (empty($product)) {
                throw new \Exception(__('Product not found'));
            }
            $currentStock = $item->code_variant ? $product->quantity : $product->stock;
            $currentCartQty = $item->quantity;
            
            $productName = $item->code_variant ? $item->product->title.' '. $product->name : $item->product->title;
            if (empty($currentStock) || $currentStock - $currentCartQty < 0) {
                throw new \Exception(__('The quantity with '. $productName . 'is not enough to continue process'));
            }
        }
    }

    public function prepareDataForOrder($userId, $addressId)
    {
        $shippingAddress = $this->prepareShippingAddress($userId, $addressId);
        $orderData['name'] = $shippingAddress->getAttribute('name');
        $orderData['email'] = $shippingAddress->getAttribute('email');
        $orderData['phone'] = $shippingAddress->getAttribute('phone_number');
        $orderData['detail_address'] = $shippingAddress->getAttribute('detail_address');
        $orderData['order_number'] = 'ORD-' . strtoupper(Str::random(10));
        $orderData['user_id'] = $userId;
        $orderData['sub_total'] = $this->getTotalCartPrice($userId);
        $orderData['quantity'] = $this->countQuantityInCart($userId);
        $orderData['total_amount'] = $this->getTotalCartPrice($userId);
        $status = $this->prepareStatusOrder();
        $orderData['status'] = $status; 
        return $orderData;
    }
    

    public function getTotalCartPrice($userId)
    {
        return Cart::where('user_id', $userId)->where('order_id', null)->sum('amount');
    }


    public function countQuantityInCart($userId)
    {
        return Cart::where('user_id', $userId)->where('order_id', null)->sum('quantity');
    }

    private function prepareStatusOrder() {

        $timeCreateOrder = Carbon::now();
        $status = DeliveryHelper::STATUS_NEW_ORDER;

        return $status;

    }

    public function show($id)
    {
        $order = Order::find($id);
        if ($order) {
            $cartHelper = new CartHelper();
            $cartProducts = $cartHelper->getAllCartByOrder($order);
            return view('backend.order.show')->with('order', $order)->with('cartProducts', $cartProducts);
        }
        request()->session()->flash('error', 'Order does not exist');
        return redirect()->back();
    }


    public function prepareShippingAddress($userId, $addressId)
    {
        $customerAddress = CustomerAddress::where('user_id', $userId)
            ->where('id', $addressId)
            ->first();
        if (empty($customerAddress)) {
            return null;
        }
        return $customerAddress;
    }
    
    public function showOrderReceipt($id)
    {
        $order = Order::find($id);

        if ($order) {
            $cartHelper = new CartHelper();
            $cartProducts = $cartHelper->getAllCartByOrder($order);
            return view('backend.order.show')->with('order', $order)->with('orderReceipt', Order::ORDER_RECEIPT)->with('cartProducts', $cartProducts);
        }

        request()->session()->flash('error', 'Order does not exist');

        return redirect()->back();
    }

    public function edit($id)
    {
        $order = Order::find($id);
        return view('backend.order.edit')->with('order', $order);
    }


    public function update(Request $request, $id)
    {
        try {
            $order = Order::find($id);
            $this->validate($request, [
                'status' => 'required|in:new,process,delivered,cancel',
            ]);
            if (!empty($request->status) && $request->status == 'delivered' && !empty($request->delivery_date)) {
                $this->validate($request, [
                    'delivery_date' => 'required|date'
                ]);
            }
            $data = $request->all();
            $userId = $order->getAttribute('user_id');
            $helper = new \App\Helpers\Api\CartHelper();
            $helper->checkAvailableToContinueProcess($userId, $id);

            if ($request->get('status') == 'delivered') {
                foreach ($order->cart as $cart) {
                    $product = $helper->getProductInfo($cart->product_id, $cart->code_variant);
                    if($cart->code_variant) {
                        $product['product']->quantity = $product['currentStock'] - $cart->quantity;
                    } else {
                        $product['product']->stock = $product['currentStock'] - $cart->quantity;
                    }

                    $product['product']->save();
                }
                if (!empty($request->delivery_date)) {
                    $order->payment_status = 'paid';
                }
            }
            $data['delivery_date'] = $request->get('delivery_date');
            $order->fill($data)->save();
            request()->session()->flash('success', __('Successfully updated order'));

        } catch (\Exception $exception) {
            request()->session()->flash('error', $exception->getMessage());
        }

        if($request->order_receipt) {
            return redirect()->route('order.receipt.show', $id);
        }

        return redirect()->route('order.show', $id);

    }

    public function showOrderDetail($id)
    {
        $cartHelper = new CartHelper();
        $order = Order::find($id);
        $cartProducts = $cartHelper->getAllCartByOrder($order);

       
        return response()->json(['data' => $order, 'cartProducts' => $cartProducts]);
    }

    public function getOrderReceipt(Request $request){
    
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $orders = Order::orderBy('id', 'DESC')
                    ->where('status', Order::STATUS_DELIVERY)
                    ->where('payment_status', 'paid');

        if ($request->has('start_date') && !empty($start_date) && $request->has('end_date') && !empty($end_date)) {
            $start_date = Carbon::parse($request->start_date)->startOfDay();
            $end_date = Carbon::parse($request->end_date)->endOfDay();
    
            $orders = $orders->whereBetween('created_at', [$start_date, $end_date]);
        }

        $orders = $orders->get();
        $totalAmount = $orders->sum('total_amount');

        return view('backend.order.index')
                ->with('orders', $orders)
                ->with('status', Order::STATUS_DELIVERY)
                ->with('orderReceipt', Order::ORDER_RECEIPT)
                ->with('totalAmount', $totalAmount)
                ->with('start_date', $start_date)
                ->with('end_date', $end_date);
    }
}
