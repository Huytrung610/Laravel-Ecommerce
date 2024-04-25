<?php
namespace App\Classes;

class Vnpay{
    protected $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    protected $vnp_Returnurl = "http://localhost/vnpay_php/vnpay_return.php";
    public function __construct(){

    }

    public function payment($orderData){

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.vnpay_return');
        $vnp_TmnCode = "C6YC6VEJ";//Mã website tại VNPAY 
        $vnp_HashSecret = "ORLRANXPCRDEEDUVUDAHCBWSSPHTYMPD"; //Chuỗi bí mật

        $vnp_TxnRef = $orderData['order_number']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo =  'Thanh toán đơn hàng '.$vnp_TxnRef. ' qua MoMo';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = intval($orderData['total_amount']) * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
 
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'errorCode' => '0',
            'message' => 'success',
            'url' => $vnp_Url
        );
        return $returnData;
    }
}