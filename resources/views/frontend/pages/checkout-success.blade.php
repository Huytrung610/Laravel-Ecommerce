@extends('frontend.layouts.master')

@section('main-content')

    @php
        $svgContent = file_get_contents(public_path('frontend/svg/index.svg'));
        echo $svgContent;

    @endphp

    {{-- <div class="wgt-checkout-success-section">
        <div class="wgt-checkout-success-main">
            <div><img class="wgt-checkout-success-img" src="{{asset('frontend/img/checkout_success.png')}}" alt=""></div>
            <div><p1 class="wgt-checkout-success-title">{{__('Order Completed!')}}</p1></div>
            <div><p2 class="wgt-checkout-success-desc">{{__('Customer can confirm this order in the order history')}}</p2></div>
        </div>
          <div class="btn-return wgt-checkout-success-btn">
            <a href="{{route('product-lists')}}" class="">< {{__('Return to Products')}}</a>
         </div> 
    </div> --}}

    
    <section id="company-services" class="padding-large">
        
            <div class="wgt-checkout-success-section d-flex justify-content-center">
                <div class="wgt-checkout-success-main">
                    <div  class="text-center" style="margin: 40px 0px;"><img style="width:150px" class="wgt-checkout-success-img" src="{{asset('frontend/img/checkout_success.png')}}" alt=""></div>
                    <div  class="text-center">
                        <p1 style="font-size: 28px; font-weight: bold;" class="wgt-checkout-success-title">{{__('Order Completed!')}}</p1>
                    </div>
                    <div  class="text-center">
                        <p2  style="font-size: 15px; " class="wgt-checkout-success-desc">{{__('Customer can confirm this order in the order history')}}</p2>
                    </div>
                    <div class="btn-return wgt-checkout-success-btn text-center" style="margin: 30px 0px">
                        <a href="{{route('index')}}" class="" style="color: green; font-size: 18px;">{{__(' < Return to Home Page')}}</a>
                    </div> 
                </div>
               
            </div>
        
    </section>
    

    


@endsection