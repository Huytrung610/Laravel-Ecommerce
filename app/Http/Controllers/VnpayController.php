<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Helpers\Api\CartHelper;
class VnpayController extends Controller
{
    public function __construct(

    ){

    }

    public function vnpay_return(Request $request){
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.vnpay_return');
        $vnp_TmnCode = "C6YC6VEJ";//Mã website tại VNPAY 
        $vnp_HashSecret = "ORLRANXPCRDEEDUVUDAHCBWSSPHTYMPD"; //Chuỗi bí mật
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
        //Config input format
        //Expire
        $startTime = date("YmdHis");
        $expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));

        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            
            if ($_GET['vnp_ResponseCode'] == '00') {
                $cartHelper = new CartHelper();
                $orderCode = [];
                $template = 'frontend.pages.checkout.vnpay';
                $orderCode['order_number'] = $request->input('vnp_TxnRef');
                Order::where('order_number',$orderCode['order_number'])->update(['payment_status' => 'paid']);
                $dataCart = $cartHelper->getAllCartByOrder($orderCode);
                return view('frontend.pages.checkout-success')->with('dataCart', $dataCart)
                ->with('template', $template)
                ->with('vnp_SecureHash', $vnp_SecureHash)
                ->with('secureHash', $secureHash);
            } 
            else {
                echo "GD Khong thanh cong";
                }
        } else {
            echo "Chu ky khong hop le";
        }
    }
}
