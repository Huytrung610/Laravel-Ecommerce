@extends('frontend.layouts.master')

@section('main-content')
@include('frontend.layouts.header_fe')
    @php
        $svgContent = file_get_contents(public_path('frontend/svg/index.svg'));
        echo $svgContent;

    @endphp
    <section id="success-checkout">
            <div class="wgt-checkout-success-section tw-flex tw-items-center tw-justify-around">
                <div class="wgt-checkout-success-main checkout-success--left">
                    <div  class="tw-flex tw-justify-center tw-my-10"><img style="width:150px" class="wgt-checkout-success-img" src="{{asset('frontend/img/checkout_success.png')}}" alt=""></div>
                    <div  class="text-center">
                        <p1 style="font-size: 28px; font-weight: bold;" class="wgt-checkout-success-title">{{__('Order Completed!')}}</p1>
                    </div>
                    <div  class="text-center">
                        <p2  style="font-size: 15px; " class="wgt-checkout-success-desc">{{__('Customer can confirm this order in the order history')}}</p2>
                        <br>
                        <p2  style="font-size: 15px; " class="wgt-checkout-success-desc">{{__('We will contact you to confirm the order. Thank you for trusting and choosing us!')}}</p2>
                    </div>
                    <div class="btn-return wgt-checkout-success-btn text-center" style="margin: 30px 0px">
                        <a href="{{route('home')}}" class="" style="color: green; font-size: 18px;">{{__(' < Return to Home Page')}}</a>
                    </div> 
                </div>
                <div class="checkout-success--right tw-flex tw-flex-col tw-gap-5 tw-w-5/12">
                    <div class="infor-cart--order tw-flex tw-flex-col tw-items-center tw-gap-3">
                        <h1 class="tw-uppercase tw-font-bold tw-text-xl">Order information</h1>
                        <div class="infor-cart--table tw-flex tw-w-full tw-flex-col tw-gap-3 tw-border tw-rounded-2xl tw-border-black tw-p-4">
                            <div class="checkout-success--order_number tw-flex tw-justify-end tw-items-center tw-gap-[6.25rem]">
                                <span class="tw-border tw-rounded-2xl tw-border-black tw-p-2 tw-font-bold">Order number: #<span>{{$dataCart['cart-shipping']->order_number}}</span></span>
                                <span>{{$dataCart['cart-shipping']->created_at}}</span>
                            </div>
                            <table class="tw-table-auto tw-border ">
                                <thead class="tw-bg-blue-400">
                                  <tr class="tw-text-center tw-h-10">
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                  </tr>
                                </thead>
                                <tbody class="tw-bg-gray-200">
                                    @foreach($dataCart['cart-products'] as $cartProduct)
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
                            <div class="tw-font-bold tw-flex tw-justify-between tw-text-xl"><h1>Total amount:</h1><h1>{{ number_format($dataCart['cart-shipping']->total_amount, 0, ',', '.') }}đ</h1></div>
                        </div>
                       
                    </div>
                    <div class="infor-user--order tw-flex tw-flex-col tw-items-center tw-gap-3">
                        <h1 class="tw-uppercase tw-font-bold tw-text-xl">receiving information</h1>
                        <div class="infor-user--content tw-border tw-rounded-2xl tw-border-black tw-p-4 tw-w-full tw-flex tw-flex-col tw-gap-3 tw-text-black">
                            <div><span>Recipient name: </span><span class="tw-font-bold">{{$dataCart['cart-shipping']->name}}</span></div>
                            <div><span>Recipient email: </span><span class="tw-font-bold">{{$dataCart['cart-shipping']->email}}</span></div>
                            <div><span>Recipient phone number: </span><span class="tw-font-bold">{{$dataCart['cart-shipping']->phone}}</span></div>
                            <div><span>Recipient detailed address: </span><span class="tw-font-bold">{{$dataCart['cart-shipping']->detail_address}}</span></div>
                            <div><span>Payment method: <span class="tw-font-bold">Payment via method <span class="tw-uppercase tw-font-bold tw-text-blue-500">{{$dataCart['cart-shipping']->payment_method}}</span></span></div>
                            @if(isset($template))
                                @include($template)
                            @endif
                        </div>
                    </div>
                </div>
                
            </div>
        
    </section>
    
@endsection