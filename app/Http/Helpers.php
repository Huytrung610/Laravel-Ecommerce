<?php

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;

// use Auth;
class Helper{


    public static function getAllProductFromCart($user_id=''){
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            return Cart::with('product')->where('user_id',$user_id)->where('order_id',null)->get();
        }
        else{
            return 0;
        }
    }
   
}

?>
