<?php

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
use DB;
use App\Models\GeneralSetting;
use App\Mail\OrderMail;

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
            $codeArray = explode(",", $codeVariant);
            $codeArray = array_map('intval', $codeArray); 
            sort($codeArray); 
            $sortedCodeVariant = implode(",", $codeArray);
            $product = ProductVariant::where('product_id', $productId)
                                            ->where('code', $sortedCodeVariant)
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
        $productHelper = new ProductHelper();
        $cartOrderArr = [];
        foreach($cartOrderArray as $cartOrd){
            $dataCart = Cart::with('product')
            ->where('id', $cartOrd->id)
            ->first();
            if ($dataCart->code_variant) {
                $sortVariantId = $productHelper->sortVariantId($dataCart->code_variant);
                $productVariant = ProductVariant::where('code', $sortVariantId)
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

    public function getGroupByProductFromCart($dailySaleProducts){
        $groupDailySaleProducts = [];
    
        foreach ($dailySaleProducts as $product) {
            $key = $product->product_id . '_' . $product->code_variant;
            
            if (!array_key_exists($key, $groupDailySaleProducts)) {
                $groupDailySaleProducts[$key] = new \stdClass();
                $groupDailySaleProducts[$key]->product_id = $product->product_id;
                $groupDailySaleProducts[$key]->code_variant = $product->code_variant;
                $groupDailySaleProducts[$key]->quantity = $product->quantity;
                $groupDailySaleProducts[$key]->amount = $product->amount;
                $groupDailySaleProducts[$key]->product = $product->product;
                if ($product->code_variant) {
                    $groupDailySaleProducts[$key]->product_variant = $product->product_variant;
                }
            } else {
                $groupDailySaleProducts[$key]->quantity += $product->quantity;
                $groupDailySaleProducts[$key]->amount += $product->amount;
            }
        }
    
        $groupDailySaleProducts = array_values($groupDailySaleProducts);
    
        return $groupDailySaleProducts;
    }
    

    public function updatePriceAfterUpdateProduct($product, $newPrice = '', $variantCode = ''){
        $existedCarts = Cart::where('order_id', null)
        ->where('product_id', $product->id)
        ->get();
        foreach($existedCarts as $existedCart){
            if($existedCart->code_variant){
                $codeVariants = explode(',', $existedCart->code_variant);
                $codeVariants = array_map('intval', $codeVariants);
                sort($codeVariants);
                $sortedCodeVariant = implode(',', $codeVariants);
            
                $productVariant = Product::findOrFail($product->id)->product_variants()->where('code',$existedCart->code_variant)->first();
                if ($productVariant) {
                    $codes = explode(',', $productVariant->code);
                    $codes = array_map('intval', $codes);
                    sort($codes);
                    $sortedCode = implode(',', $codes);
            
                    if ($sortedCode == $sortedCodeVariant) {
                        $existedCart->update([
                            'price' => $productVariant->price,
                            'amount' => $existedCart->quantity * $productVariant->price
                        ]);
                    }
                }
            }else{
                
                if ($product) {
                    $existedCart->update([
                        'price' => $product->price,
                        'amount' => $existedCart->quantity * $product->price
                    ]);
                }
            }
        }
    }
    public function deleteInactiveProductCart($product){
        Cart::where('product_id', $product->id)->where('order_id', null)->delete();
    }
    public function restoreInactiveProductCart($product)
    {
        Cart::onlyTrashed()
            ->where('product_id', $product->id)
            ->where('order_id', null)
            ->restore();
    }

    public function handleAfterUpdateVariantToCart($variantsData, $product)
    {
        $existedCarts = Cart::where('product_id', $product->id)
                            ->where('order_id', null)
                            ->get();

        foreach ($existedCarts as $cart) {
            $codeVariants = explode(',', $cart->code_variant);
            $codeVariants = array_map('intval', $codeVariants);
            
            sort($codeVariants);
            
            $sortedCodeVariant = implode(',', $codeVariants);

            if (!$product->product_variants->contains('code', $sortedCodeVariant)) {
                $cart->forceDelete();
            } else {
                $isVariantEqual = false;

                $productVariant = $product->product_variants->where('code', $sortedCodeVariant)->first();
                
                $codes = explode(',', $productVariant->code);
                $codes = array_map('intval', $codes);
                
                sort($codes);
                
                $sortedCode = implode(',', $codes);
                
                if ($sortedCode == $sortedCodeVariant) {
                    $isVariantEqual = true;
                    // $cart->update(['code_variant' => $codes]);
                }

                if (!$isVariantEqual) {
                    $cart->delete();
                }
            }
        }
    }

    public function mail($order, $template = null, $vnp_SecureHash = '', $secureHash = ''){
        $generalMail = GeneralSetting::first();
        $to = $order['cart-shipping']->email ?? '';
        $cc = $generalMail->email;

        \Mail::to($to)->cc($cc)->send(new OrderMail($order, $template, $vnp_SecureHash, $secureHash));
    }

}

