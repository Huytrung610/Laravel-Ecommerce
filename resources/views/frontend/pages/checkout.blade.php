@extends('frontend.layouts.master')
@section('title', env('APP_NAME') . ' || My Cart')
@section('main-content')
@include('frontend.layouts.header_fe')

@php
$svgContent = file_get_contents(public_path('frontend/svg/cart.svg'));
echo $svgContent;
$user = auth()->user() ?? null;
$listAddress = $user->getAddress();
$addressDefault = $user->getAddressDefault() ?? $listAddress->first();

@endphp

<section class="hero-section position-relative bg-light-blue padding-medium" style="padding-top: 2em;padding-bottom: 2em;">
    <div class="hero-content">
      <div class="container">
        <div class="row">
          <div class="text-center padding-large no-padding-bottom">
            <h1 class="display-2 text-uppercase text-dark">Cart</h1>
            <div class="breadcrumbs">
              <span class="item">
                <a href="/">Home ></a>
              </span>
              <span class="item">Cart</span>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<section class="shopify-cart padding-large" style="padding-top: 3em;padding-bottom: 3em;">
  <div class="container">
    <div class="row">
      <div class="cart-table col-lg-8">
        <div class="cart-header">
          <div class="row d-flex">
            <h3 class="cart-title col-lg-5 pb-4">Product</h3>
            <h3 class="cart-title col-lg-3 pb-3">Quantity</h3>
            <h3 class="cart-title col-lg-4 pb-3">Price</h3>
          </div>
        </div>
        
        <form action="{{route('cart.update')}}" id="cart-products" method="POST">
          @csrf
            @foreach(Helper::getAllProductFromCart() as $key=>$cart)
              <div class="cart-item border-top border-bottom ">
                <div class="row align-items-center tw-py-5">
                    <div class="col-lg-5 col-md-4">
                      <div class="cart-info d-flex align-items-center mb-4 tw-flex-nowrap">
                        <div class="card-image">
                          @php
                              $firstImagePath = asset('images/placeholder.png');
                              if (!empty($cart->product_variant->image)) {
                                  $imagePaths = explode(',', $cart->product_variant->image) ?? $cart->product_variant->image;
                                  $firstImagePath = asset($imagePaths[0]);
                              } elseif (!empty($cart->product->photo)) {
                                  $imagePaths = explode(',', $cart->product->photo);
                                  $firstImagePath = asset($imagePaths[0]);
                              }
                          @endphp
                          <img src="{{$firstImagePath}}" alt="{{$firstImagePath}}" class="img-fluid tw-w-[100px] tw-h-[120px]">
                      </div>
                        <div class="card-detail ps-3">
                            <h3 class="card-title">
                                @php
                                    $productHelper = new \App\Helpers\Backend\ProductHelper();
                                    if($cart->code_variant){
                                        $productName = $cart->product->title .' '. $cart->product_variant->name;
                                        $productPrice =  $productHelper->formatPrice($cart->product_variant->price);
                                    } else {
                                        $productName = $cart->product->title;
                                        $productPrice =  $productHelper->formatPrice($cart->product->price);
                                    } 
                                @endphp
                                <a href="{{ route('product-detail', ['slug' => $cart->product->slug]) }}" class="tw-text-base">{{$productName}}</a>
                            </h3>
                            <div class="card-price">
                                <span class="money text-primary">{{$productPrice}}đ</span>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                      <div class="row d-flex">
                          <div class="col-md-6">
                            <div class="qty-field">
                                <div class="qty-number input-group d-flex">
                                  <div class="product-cart--qty">
                                    <span class="minus bg-dark">-</span>
                                    <input type="number" id="quantity_pro1" class="count" name="quant[{{$key}}]" value="{{$cart->quantity}}">
                                    <input type="hidden" name="qty_id[{{$key}}]" value="{{$cart->id}}">
                                    <span class="plus bg-dark">+</span>
                                  </div>
                                </div>
                                <div class="regular-price"></div>
                                <div class="quantity-output text-center bg-primary"></div>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="total-price">
                              <span class="text-primary tw-text-base">{{ number_format($cart['amount'], 0, ',', '.') }}đ</span>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="col-lg-1 col-md-1">
                      <div class="cart-remove">
                          <a href="{{route('cart-delete',$cart->id)}}">
                            <svg class="close" width="28px">
                                <use xlink:href="#close"></use>
                            </svg>
                          </a>
                      </div>
                    </div>
                </div>
              </div>
            @endforeach
          <div class="cart-totals bg-grey padding-medium">
            <div class="button-wrap">
              <button type="submit" class="btn btn-black btn-medium text-uppercase me-2 mb-3 btn-rounded-none">Update Cart</button>
              <a href="{{route('home')}}" class="btn btn-black btn-medium text-uppercase me-2 mb-3 btn-rounded-none">Continue Shopping</a>
            </div>
          </div>
        </form> 
      </div>
      <div class="cart-checkout col-lg-4">
        <div class="cart-totals bg-grey padding-medium" style="padding-top: 0em; padding-bottom:0em;">
          <h4 class="display-7 text-uppercase text-dark pb-4 tw-font-bold" >CHECK OUT YOUR ORDER</h4>
          <form class="form" method="POST" action="{{route('cart.order')}}">
            @csrf
            <div class="cart-totals bg-grey ">
  
              <div class="total-price ">
                <table cellspacing="0" class="table text-uppercase">
                  <tbody>
                    <tr class="order-total pt-2 pb-2 border-bottom">
                      <th>Total:</th>
                      <td data-title="Sub total">
                        <span class="price-amount amount text-primary ps-5">
                            <span class="price-currency-symbol tw-font-bold" data-price="{{Helper::totalCartPrice()}}">{{ number_format(Helper::totalCartPrice(), 0, ',', '.') }}đ</span>
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            @include('frontend.pages.checkout.payment-method')

            @include('frontend.pages.checkout.contact-infor')
            <div class="checkout-btn--container tw-flex tw-justify-end"> 
              <button class="btn btn-black btn-medium text-uppercase me-2 mb-3 btn-rounded-none tw-mt-5" type="submit">Confirm Order</button>
            </div>
          </form>
        </div>
        </div>
      </div>
    </div>
  </div>
</section> 
@push('after_scripts')
  <link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
  <script src="{{ mix('js/frontend/checkout.js') }}"></script>
  
@endpush

@endsection 
