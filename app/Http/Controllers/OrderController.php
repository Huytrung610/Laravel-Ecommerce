<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Config;

class OrderController extends Controller
{
    
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        return view('backend.order.index')->with('orders', $orders);
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
            
            $paymentMethod = $request->get('payment-method');
            if ($paymentMethod === 'vnpay') {
                $order = new Order();
                $this->checkAvailableToContinueProcess($currentUserId);
                $orderData = $this->prepareDataForOrder($currentUserId, $addressId);
                $orderData['order_number'] = 'ORD-' . strtoupper(Str::random(10));
                $orderData['payment_method'] = 'vnpay';
                $orderData['payment_status'] = 'unpaid';
                $order->fill($orderData);
                $order->save();
    
                session()->put('order_number', $order->order_number);
    
                $vnpUrl = config('app.VNPAY_URL');
                $vnpTmnCode = config('app.VNPAY_TMNCODE');
                $vnpHashSecret = config('app.VNPAY_HASHSECRET');
                $vnpReturnUrl = config('app.VNPAY_RETURN_URL');
    
                $vnpParams = array(
                    'vnp_Version' => '2.0.0',
                    'vnp_TmnCode' => $vnpTmnCode,
                    'vnp_Amount' => $order->total_amount * 100,
                    'vnp_Command' => 'pay',
                    'vnp_CreateDate' => date('YmdHis'),
                    'vnp_CurrCode' => 'VND',
                    'vnp_IpAddr' => request()->ip(),
                    'vnp_Locale' => 'vn',
                    'vnp_OrderInfo' => 'Thanh toan don hang ' . $order->order_number,
                    'vnp_OrderType' => '',
                    'vnp_ReturnUrl' => $vnpReturnUrl,
                    'vnp_TxnRef' => $order->order_number,
                    'vnp_SecureHashType' => 'SHA256',
                );
                ksort($vnpParams);
                $query = '';
                $i = 0;
                $hashdata = '';
    
                foreach ($vnpParams as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . $key . "=" . $value;
                    } else {
                        $hashdata .= $key . "=" . $value;
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }
    
                $vnpSecureHash = hash('sha256', $vnpHashSecret . $hashdata);
                $vnpUrl = $vnpUrl . "?" . $query . 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
                // dd($vnpUrl);
                return redirect()->away($vnpUrl);
            }
            
            // Handle other payment methods (e.g., cash on delivery)
            // ...
            
            return redirect()->route('checkout.success');
        } catch (\Exception $exception) {
            request()->session()->flash('error', $exception->getMessage());
            return back();
        }
    }
    
    public function checkAvailableToContinueProcess($currentUserId, $orderId = null)
    {
        $allCartItem = Cart::where('user_id', $currentUserId)->where('order_id', $orderId)->get();
        $productHelper = new ProductHelper();
        if ($allCartItem->count() <= 0) {
            throw new \Exception(__('No cart item available'));
        }
        foreach ($allCartItem as $item) {
            $productId = $item->getAttribute('product_id');
            $product = Attribute::where('id', $productId)->first();
            if (empty($product)) {
                throw new \Exception(__('Product not found'));
            }
            $currentStock = $product->getAttribute('stock');
            $currentCartQty = $item->getAttribute('quantity');
            $productSlug = $product->sku ?? '';
            $productName = $productHelper->convertSlugToTitle($productSlug);
            
            if (empty($currentStock) || $currentStock - $currentCartQty < 0) {
                throw new \Exception(__('The quantity with ' . $productName . ' is not enough to continue the process'));
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
        // Set Status order with delivery time setting
        $status = $this->prepareStatusOrder();
    
        $orderData['status'] = $status;
        $orderData['payment_method'] = 'cod';
        $orderData['payment_status'] = 'Unpaid';
    
        return $orderData;
    }
    
    public function handleVNPayCallback(Request $request)
    {
        try {
            $vnp_TmnCode = config('app.VNPAY_TMNCODE');
            $vnp_HashSecret = config('app.VNPAY_HASHSECRET');
    
            $inputData = $request->all();
            $vnp_SecureHash = $inputData['vnp_SecureHash'];
            unset($inputData['vnp_SecureHash']);
    
            ksort($inputData);
            $hashData = '';
            foreach ($inputData as $key => $value) {
                if ($key != 'vnp_SecureHashType' && $key != 'vnp_SecureHash') {
                    $hashData .= $key . '=' . $value . '&';
                }
            }
    
            $secureHash = hash('sha256', $vnp_HashSecret . $hashData);
            if ($secureHash == $vnp_SecureHash) {
                $orderId = session()->get('order_id');
                $order = Order::findOrFail($orderId);
    
                $order->payment_status = 'paid';
                $order->save();
    
                session()->forget('order_id');
    
                return redirect()->route('checkout.success');
            } else {
                throw new \Exception(__('Invalid VNPay callback'));
            }
        } catch (\Exception $exception) {
            request()->session()->flash('error', $exception->getMessage());
            return redirect()->route('checkout.failed');
        }
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
            return view('backend.order.show')->with('order', $order);
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
            return view('backend.order.show')->with('order', $order)->with('orderReceipt', Order::ORDER_RECEIPT);
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
                    $product = $cart->product_attr;
                    $product->stock -= $cart->quantity;
                    $product->save();
                }
            }

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
    $productHelper = new ProductHelper();
    $order = Order::find($id);
    $orderItems = $order->cart_info ?? [];
    $listProductId = [];
    foreach ($orderItems as $item){
        $listProductId[] = $item['product_id'];
    }
    $listProductAttr = [];
    $attributeModel = new Attribute();
    foreach($listProductId as $productId){
        $listProductAttr[] = $attributeModel->getSku($productId);
    }
    $listProductName = [];
    foreach($listProductAttr as $productAttr){
        $listProductName[] = $productHelper->convertSlugToTitle($productAttr);
    }
   
    if (!$order) {
        return response()->json(['error' => 'Order not found'], 404);
    } 

    return response()->json(['data' => $order, 'listProductName' => $listProductName]);
}


}
