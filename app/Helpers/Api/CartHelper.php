<?php
/**
 *
 * Copyright © 2022 Wgentech. All rights reserved.
 * See COPYING.txt for license details.
 *
 * @author    Wgentech Dev Team
 * @author    binhnt@mail.wgentech.com
 *
 */

namespace App\Helpers\Api;

use App\Models\Cart;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;
use App\Helpers\Backend\ProductHelper;
use App\Models\Attribute;

class CartHelper
{

    
    /**
     * Handle product is out of stock when create Order
     *
     * @param $currentUserId
     * @param null $orderId
     * @return void
     * @throws \Exception
     */
    public function checkAvailableToContinueProcess($currentUserId, $orderId = null) {
        $allCartItem = Cart::where('user_id', $currentUserId)->where('order_id', $orderId)->get();
        $productHelper = new ProductHelper();
        if ($allCartItem->count() <= 0) {
            throw new \Exception(__('No cart item available'));
        }
        foreach ($allCartItem as $item) {
            $productId = $item->product_id;
            $codeVariant = $item->code_variant;
            
            try {
                $productInfo = $this->getProductInfo($productId, $codeVariant);
                $productName = $productInfo['productName'];
                $currentStock = $productInfo['currentStock'];
    
                $currentCartQty = $item->quantity;
    
                if ($currentStock - $currentCartQty < 0) {
                    throw new \Exception(__('The quantity of ' . $productName . ' is not enough to continue processing'));
                }
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
    }

    public function getProductInfo($productId, $codeVariant = null)
    {
        if (!empty($codeVariant)) {
            $product = ProductVariant::where('product_id', $productId)
                                            ->where('code', $codeVariant)
                                            ->with('product')
                                            ->first();

            $productName = $product->product->title . ' ' . $product->name;
            $currentStock = $product->quantity;
            if (!$product) {
                throw new \Exception($productName . 'not found');
            }

            
        } else {
            $product = Product::find($productId);
            $productName = $product->title;
            $currentStock = $product->stock;
            if (!$product) {
                throw new \Exception($productName . 'not found');
            }

           
        }

        return [
            'product' => $product,
            'productName' => $productName,
            'currentStock' => $currentStock
        ];
    }
    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function getAllCartByOrder($order){
        $allInfoOrder = [];
        $orderId = Order::where('order_number', $order['order_number'])->first();
        $cartData = Cart::where('order_id', $orderId->id)->get();
        $allInfoOrder['cart-shipping'] = $orderId;
        $allInfoOrder['cart-products'] = $this->getAllProductFromCartOrder($cartData);
        
        return $allInfoOrder;
    }

    public function getAllProductFromCartOrder($cartOrderArray){
        $cartOrderArr = [];
        foreach($cartOrderArray as $cartOrd){
            $dataCart = Cart::with('product')
            ->where('id', $cartOrd->id)
            ->first();
            if ($dataCart->code_variant) {
                $productVariant = ProductVariant::where('code', $dataCart->code_variant)
                    ->where('product_id', $dataCart->product_id)
                    ->first();

                if ($productVariant) {
                    $dataCart->product_variant = $productVariant;
                }
            }
            $cartOrderArr[] = $dataCart;
        }
        return $cartOrderArr;
    }
}

