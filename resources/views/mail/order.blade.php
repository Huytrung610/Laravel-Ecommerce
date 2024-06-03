<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
    <style>
        .wgt-checkout-mail-section {
            display: flex;
            align-items: center;
            justify-content: space-around;
        }
        .wgt-checkout-mail-section .infor-cart--order {
            text-align: center;
        }
        .wgt-checkout-mail-section .checkout-success--right {
            width: 700px;
        }
        .wgt-checkout-mail-section .infor-cart--table {
            border: 1px solid #000;
            padding: 16px;
            border-radius: 12px;
        }
        .wgt-checkout-mail-section .checkout-success--order_number {
            margin-bottom: 20px;
            float: right;
            margin-right: 87px;
            align-items: center;
            gap: 6.25rem;
        }
        .wgt-checkout-mail-section .order_number--content {
            border: 1px solid #000;
            border-radius: 18px;
            padding: 8px;
            font-weight: 600;
        }
        .wgt-checkout-mail-section .table-mail--order  {
            width:  650px;
            margin: 0 auto;
            border: 1px solid #000;
        }
        .wgt-checkout-mail-section .checkout-success_time {
            padding-top: 10px;
            margin-left: 10px;

        }
        .wgt-checkout-mail-section .infor-user--order {
            align-items: center;
            gap: 12px;
        }
        .wgt-checkout-mail-section .infor-mail-user {
            display: flex;
            flex-direction: column;
            font-size: 1.25rem;
            line-height: 1.75rem;
            text-transform: uppercase;
            font-weight: 700;
        }
        .wgt-checkout-mail-section .cart__total-amount {
            text-align: right;
            font-weight: 700;
            justify-content: space-between;
            justify-content: flex-end;
            font-size: 10px;
            line-height: 1.75rem;
            
        }
        .wgt-checkout-mail-section .table-cart-body {
            background-color: #E5E7EB;
        }
        .wgt-checkout-mail-section .infor-user--content {
            color: #000;
        }
    </style>
</head>
<body>
    <div class="wgt-checkout-mail-section">
        <div class="checkout-success--right tw-flex tw-flex-col tw-gap-5 tw-w-5/12">
            <div class="infor-cart--order tw-flex tw-flex-col tw-items-center tw-gap-3">
                <h1 class="tw-uppercase tw-font-bold tw-text-xl">Order information</h1>
                <div class="infor-cart--table">
                    <div class="checkout-success--order_number">
                        <span class="order_number--content">Order number: #<span>{{$order['cart-shipping']->order_number}}</span></span>
                        <span class="checkout-success_time">{{$order['cart-shipping']->created_at}}</span>
                    </div>
                    <table class="table-mail--order tw-table-auto tw-border">
                        <thead class="tw-bg-blue-400">
                          <tr class="tw-text-center tw-h-10">
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                          </tr>
                        </thead>
                        <tbody class="table-cart-body">
                            @foreach($order['cart-products'] as $cartProduct)
                            @php
                                $productHelper = new \App\Helpers\Backend\ProductHelper();
                                if($cartProduct->code_variant){
                                    $productName = $cartProduct->product->title .' '. $cartProduct->product_variant->name;
                                    $productPrice =  $productHelper->formatPrice($cartProduct->price);
                                } else {
                                    $productName = $cartProduct->product->title;
                                    $productPrice =  $productHelper->formatPrice($cartProduct->product->price);
                                } 
                            @endphp
                          <tr class="tw-text-center">
                            <td class="tw-p-3">{{$productName}}</td>
                            <td class="tw-p-3">{{ $cartProduct->quantity }}</td>
                            <td class="tw-p-3">{{$productPrice}}đ</td>
                            <td class="tw-p-3">{{ $productHelper->formatPrice($cartProduct->amount) }}đ</td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                    <div class="cart__total-amount"><h1 class="cart__total-amount--title">Total amount:</h1><h1>{{ number_format($order['cart-shipping']->total_amount, 0, ',', '.') }}đ</h1></div>
                </div>
            </div>
            <div class="infor-user--order" style="flex-direction: column">
                <h1 class="infor-mail-user">receiving information</h1>
                <div class="infor-user--content tw-border tw-rounded-2xl tw-border-black tw-p-4 tw-w-full tw-flex tw-flex-col tw-gap-3 tw-text-black">
                    <div><span>Recipient name: </span><span class="tw-font-bold">{{$order['cart-shipping']->name}}</span></div>
                    <div><span>Recipient email: </span><span class="tw-font-bold">{{$order['cart-shipping']->email}}</span></div>
                    <div><span>Recipient phone number: </span><span class="tw-font-bold">{{$order['cart-shipping']->phone}}</span></div>
                    <div><span>Recipient detailed address: </span><span class="tw-font-bold">{{$order['cart-shipping']->detail_address}}</span></div>
                    <div><span>Payment method: <span class="tw-font-bold">Payment via method <span class="tw-uppercase tw-font-bold tw-text-blue-500">{{$order['cart-shipping']->payment_method}}</span></span></div>
                    @if(isset($template))
                       @include($template, ['vnp_SecureHash' => $vnp_SecureHash, 'secureHash' => $secureHash])
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
