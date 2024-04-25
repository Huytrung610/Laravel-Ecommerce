<div class="form-group">
    <label >Mã đơn hàng:</label>

    <label>{{ $_GET['vnp_TxnRef'] }}</label>
</div>    
<div class="form-group">

    <label >Amount of money:</label>
    <label>{{ $_GET['vnp_Amount'] }}</label>
</div>  
<div class="form-group">
    <label >Content billing:</label>
    <label>{{ $_GET['vnp_OrderInfo'] }}</label>
</div> 
<div class="form-group">
    <label >Response code (vnp_ResponseCode):</label>
    <label>{{ $_GET['vnp_ResponseCode'] }}</label>
</div> 
<div class="form-group">
    <label >Transaction code At VNPAY:</label>
    <label>{{ $_GET['vnp_TransactionNo'] }}</label>
</div> 
<div class="form-group">
    <label >Bank code:</label>
    <label>{{ $_GET['vnp_BankCode'] }}</label>
</div> 
<div class="form-group">
    <label >Payment time:</label>
    <label>{{ $_GET['vnp_PayDate'] }}</label>
</div> 
<div class="form-group">
    <label >Result:</label>
    <label>
        
        @if ($secureHash == $vnp_SecureHash) 
            @if ($_GET['vnp_ResponseCode'] == '00') 
                <span style='color:blue'>Payment through VNPAY portal was successful</span>
            @else 
                <span style='color:red'>Payment via VNPAY portal failed</span>
            @endif
        @else 
            <span style='color:red'>Invalid signature</span>
        @endif
    </label>
</div> 