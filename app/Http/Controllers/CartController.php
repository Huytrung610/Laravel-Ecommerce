<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\ProductVariant;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    // public function singleAddToCart(Request $request){
    //     $data = $request->all();
    //     $request->validate([
    //         'quant'      =>  'required',
    //     ]);
    //     $attributeId = '';
    //     $product = Product::where('id', $data['product_id'])->first();
    //     if($product->has_variants) {
    //         $attributeId = $data['code_product_variant'];
    //         $productVariant = ProductVariant::findVariant($attributeId, $product->id );
    //         if($productVariant->quantity < $request->quant[1]){
    //             return back()->with('error','Out of stock, You can choose other products.');
    //         }
    //         if ( ($request->quant[1] < 1) || empty($product) ) {
    //             request()->session()->flash('error','Invalid Products');
    //             return back();
    //         }
    //     }
        
    //     $already_cart = Cart::where('user_id', auth()->user()->id)
    //                     ->where('order_id',null)
    //                     ->where('product_id', $product->id)
    //                     ->where('code_variant', $attributeId)
    //                     ->first();

    //     if($already_cart) {
    //         $already_cart->quantity = $already_cart->quantity + $request->quant[1];
    //         $already_cart->amount = (($productVariant->price ?? $product->price) * $request->quant[1]) + $already_cart->amount;
            
    //         if ($already_cart->code_variant && $already_cart->productVariant->quantity < $already_cart->quantity ){
    //             return back()->with('error','Stock not sufficient!.');
    //         } elseif (!$already_cart->code_variant && $already_cart->product->stock < $already_cart->quantity) {
    //             return back()->with('error','Stock not sufficient!.');
    //         }
             

    //         $already_cart->save();

    //     }else{

    //         $cart = new Cart;
    //         $cart->user_id = auth()->user()->id;
    //         $cart->product_id = $product->id;
    //         $cart->price = $productVariant->price ?? $product->price;
    //         $cart->quantity = $request->quant[1] ?? $product->stock;
    //         $cart->code_variant = $attributeId ?? '';
    //         $cart->amount = ($productVariant->price ?? $product->price) * $request->quant[1];
    //         if($cart->code_variant && $cart->productVariant->quantity < $cart->quantity ) {
    //             return back()->with('error','Stock not sufficient!.');
    //         } elseif (!$cart->code_variant &&  $cart->product->stock < $cart->quantity) {
    //             return back()->with('error','Stock not sufficient!.');
    //         }
    //         $cart->save();
    //     }
    //     request()->session()->flash('success','Product successfully added to cart.');
    //     return back();
    // }

    public function singleAddToCart(Request $request)
{
    $request->validate([
        'quant' => 'required',
    ]);

    $data = $request->all();
    $product = Product::find($data['product_id']);

    
    if ($product->has_variants) {
        $productVariant = ProductVariant::findVariant($data['code_product_variant'], $product->id);

        if ($productVariant->quantity < $request->quant[1]) {
            return back()->with('error', 'Out of stock, You can choose other products.');
        }
    } else {
        if ($product->stock < $request->quant[1]) {
            return back()->with('error', 'Out of stock, You can choose other products.');
        }
    }

    $already_cart = Cart::where('user_id', auth()->user()->id)
        ->where('order_id', null)
        ->where('product_id', $product->id)
        ->where('code_variant', $data['code_product_variant'] ?? '')
        ->first();

    $new_quantity = $already_cart ? $already_cart->quantity + $request->quant[1] : $request->quant[1];
    $price = $productVariant->price ?? $product->price;
    $amount = $price * $new_quantity;

    if ($product->has_variants && $productVariant->quantity < $new_quantity) {
        return back()->with('error', 'Stock not sufficient!.');
    } elseif (!$product->has_variants && $product->stock < $new_quantity) {
        return back()->with('error', 'Stock not sufficient!.');
    }

    if ($already_cart) {
        $already_cart->quantity = $new_quantity;
        $already_cart->amount = $amount;
        $already_cart->save();
    } else {
        $cart = new Cart;
        $cart->user_id = auth()->user()->id;
        $cart->product_id = $product->id;
        $cart->price = $price;
        $cart->quantity = $new_quantity;
        $cart->code_variant = $data['code_product_variant'] ?? '';
        $cart->amount = $amount;
        $cart->save();
    }

    request()->session()->flash('success', 'Product successfully added to cart.');
    return back();
}

    public function checkout(Request $request){
        try {
            $listAddress = auth()->user()->getAddress();
            $addressDefault = auth()->user()->getAddressDefault() ?? $listAddress->first() ?? null;
            if (!$addressDefault) {
                $flash = array(
                    'status' => 'success',
                    'message' => 'Please add contact information'
                );
                return redirect()->route('profile', ['addressList' => $listAddress, 'defaultAddress' => $addressDefault])->with($flash['status'], $flash['message']);
            }
        } catch (\Exception $exception) {
                session()->flash('error', $exception->getMessage());
            }

        return view('frontend.pages.checkout');
    }


    public function cartUpdate(Request $request){
        if($request->quant){
            $error = array();
            $success = '';

            foreach ($request->quant as $k=>$quant) {
                $id = $request->qty_id[$k];
                $cart = Cart::find($id);
                if($quant > 0 && $cart) {
                    $qtyProduct = $cart->code_variant ? $cart->productVariant->quantity : $cart->product->stock;
                    $productName = $cart->code_variant ? $cart->product->title.' '. $cart->productVariant->name : $cart->product->title;
            
                    if( $qtyProduct < $quant){
                        request()->session()->flash('error',$productName .' only has ' .$qtyProduct . ' left');
                        return back();
                    }
                    $cart->quantity = ( $qtyProduct > $quant) ? $quant  :  $qtyProduct;

                    if ( $qtyProduct <= 0) continue;
                    
                    /** @var ProductVariant $productVariant */
                    /** @var Product $product */
                    $cart->amount = $cart->code_variant ? $cart->productVariant->getPrice() * $quant : $cart->product->getPrice() * $quant;
                    $cart->save();
                    $success = 'Cart successfully updated!';
                    
                }else{
                    $error[] = 'Cart Invalid!';
                }
            }
            return back()->with($error)->with('success', $success);
        }else{
            return back()->with('Cart Invalid!');
        }
    }

    public function showSuccessCheckout(Request $request)
    {
        return view('frontend.pages.checkout-success');
    }

    public function cartDelete(Request $request){
        $cart = Cart::find($request->id);
        if ($cart) {
            $cart->delete();
            request()->session()->flash('success','Cart successfully removed');
            return back();
        }
        request()->session()->flash('error','Error please try again');
        return back();
    }

}
