@extends('frontend.layouts.master')

@section('main-content')
    <div class="wgt-checkout-success-section">
        <div class="wgt-checkout-success-main">
            <div><img class="wgt-checkout-success-img" src="{{asset('frontend/img/checkout_success.png')}}" alt=""></div>
            <div><p1 class="wgt-checkout-success-title">{{__('Order Completed!')}}</p1></div>
            <div><p2 class="wgt-checkout-success-desc">{{__('Customer can confirm this order in the order history')}}</p2></div>
        </div>
        {{-- <div class="btn-return wgt-checkout-success-btn">
            <a href="{{route('product-lists')}}" class="">< {{__('Return to Products')}}</a>
        </div> --}}
    </div>

@endsection