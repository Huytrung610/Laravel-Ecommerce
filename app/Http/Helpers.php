<?php

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\ProductVariant;

// use Auth;
class Helper{

    public static function getAllProductFromCart($user_id = '')
{
    if (Auth::check()) {
        if ($user_id == "") {
            $user_id = auth()->user()->id;
        }

        $carts = Cart::where('user_id', $user_id)
            ->where('order_id', null)
            ->with(['product' => function ($query) {
                $query->where('status', 'active');
            }])
            ->get();

        foreach ($carts as $cart) {
            if ($cart->product && $cart->product->status === 'active') {
                if ($cart->code_variant) {
                    $productVariant = ProductVariant::where('code', $cart->code_variant)
                        ->where('product_id', $cart->product_id)
                        ->first();

                    if ($productVariant) {
                        $cart->product_variant = $productVariant;
                    }
                }
            } else {
                $carts = $carts->filter(function($item) use ($cart) {
                    return $item->id !== $cart->id;
                });
            }
        }

        return $carts;
    } else {
        return 0;
    }
}



    public static function totalCartPrice($user_id=''){
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            return Cart::where('user_id',$user_id)->where('order_id',null)->active()->sum('amount');
        }
        else{
            return 0;
        }
    }

    public static function cartCount($user_id=''){

        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            return Cart::where('user_id',$user_id)->where('order_id',null)->active()->sum('quantity');
        }
        else{
            return 0;
        }
    }
}

?>
