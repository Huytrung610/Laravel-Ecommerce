<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Models\Order;
use App\Models\Attribute;
use App\Models\Cart;
use App\Models\User;
use App\Models\NewsletterSubcriber;
use App\Helpers\Backend\OrderHelper;
use App\Helpers\Api\CartHelper;


use DB;

class AdminController extends Controller
{
    public function index(){

     return view('backend.index');
    }
    
    public function getRevenue(Request $request)
    {
        $order = new Order();

        $orderHelper = new OrderHelper();
        $cartHelper = new CartHelper();

        $orderStatistic = $orderHelper->orderStatistic();
        $revenueByMonth = Order::where('status', 'delivered')
            ->select(DB::raw('DATE_FORMAT(delivery_date, "%Y-%m") AS month'), DB::raw('SUM(total_amount) AS total_revenue'), DB::raw('SUM(quantity) AS total_quantity'))
            ->groupBy('month')
            ->get();

        $totalRevenue = Order::getTotalRevenue();
        $totalOrder = Order::getTotalOrders();
        $cancelOrder = Order::getCancelOrders();
        $totalCustomer = User::totalCustomers();
        $totalSubcribers = NewsletterSubcriber::getAllSubcriber()->count();

        foreach ($revenueByMonth as $revenue) {

            $labels[] = $revenue['month'];
            $revenues[] = $revenue['total_revenue'];
            $quantities[] = $revenue['total_quantity'];
        }
        return view('backend.index', compact('quantities'))
                                ->with('totalRevenue', $totalRevenue)
                                ->with('orderStatistic', $orderStatistic)
                                ->with('cancelOrder', $cancelOrder)
                                ->with('totalCustomer', $totalCustomer)
                                ->with('totalSubcribers', $totalSubcribers)
                                ->with('totalOrder', $totalOrder);
    }

    public function getDailyRevenue(Request $request)
    {
        $selectedDate = $request->input('selected_date');

        $carts = Cart::whereDate('created_at', $selectedDate)
            ->whereHas('order', function ($query) {
                $query->where('status', 'delivered')
                    ->where('payment_status', 'paid');
            })
            ->get();

        $cartHelper = new CartHelper();
        $dailySaleProducts = $cartHelper->getAllProductFromCartOrder($carts) ?? [];
        $groupDailySaleProducts = $cartHelper->getGroupByProductFromCart($dailySaleProducts);

        $totalDailyRevenue = $carts->sum('amount');

        return response()->json([
            'groupDailySaleProducts' => $groupDailySaleProducts,
            'totalDailyRevenue' => $totalDailyRevenue
        ]);
    }

    public function profile()
    {
        $profile = backpack_user();

        return view('backend.users.profile')->with('profile', $profile);
    }

    public function changePassword()
    {
        return view('backend.layouts.changePassword');
    }

    public function changPasswordStore(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|different:current_password|min:6',
            'new_confirm_password' => 'same:new_password',
        ]);
        if (Hash::check($request->current_password, backpack_auth()->user()->password)) {
            backpack_auth()->user()->fill([
                'password' => Hash::make($request->new_password)
            ])->save();
            $request->session()->flash('success', 'Password successfully changed');
        } else {
            $request->session()->flash('error', 'Password does not match');
        }

        return redirect()->route('admin');
    }
}



