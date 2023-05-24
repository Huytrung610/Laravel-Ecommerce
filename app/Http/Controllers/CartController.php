<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\Cart;

class CartController extends Controller
{
    public function singleAddToCart(Request $request){
        $request->validate([
            'sku'      =>  'required',
            'quant'      =>  'required',
        ]);

        $product = Attribute::where('sku', $request->sku)->first();
        if($product->stock < $request->quant[1]){
            return back()->with('error','Out of stock, You can add other products.');
        }
        if ( ($request->quant[1] < 1) || empty($product) ) {
            request()->session()->flash('error','Invalid Products');
            return back();
        }

        $already_cart = Cart::where('order_id',null)->where('product_id', $product->id)->first();


        if($already_cart) {
            $already_cart->quantity = $already_cart->quantity + $request->quant[1];
            /** @var Product $product */
            $already_cart->amount = ($product->price * $request->quant[1])+ $already_cart->amount;

            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');

            $already_cart->save();

        }else{

            $cart = new Cart;
            $cart->product_id = $product->id;
            $cart->price = $product->price;
            $cart->quantity = $request->quant[1];
            $cart->amount= ($product->price * $request->quant[1]);
            if ($cart->product_attr->stock < $cart->quantity || $cart->product_attr->stock <= 0) return back()->with('error','Stock not sufficient!.');
            // return $cart;
            $cart->save();
        }
        request()->session()->flash('success','Product successfully added to cart.');
        return back();
    }

    public function checkout(Request $request){
        return view('frontend.pages.checkout');
    }
}
