@extends('frontend.layouts.master')
@section('title', env('APP_NAME') . ' || My Cart')
@section('main-content')
@include('frontend.layouts.header_fe')

@php
$svgContent = file_get_contents(public_path('frontend/svg/cart.svg'));
echo $svgContent;

@endphp

<section class="hero-section position-relative bg-light-blue padding-medium" style="padding-top: 2em;padding-bottom: 2em;">
    <div class="hero-content">
      <div class="container">
        <div class="row">
          <div class="text-center padding-large no-padding-bottom">
            <h1 class="display-2 text-uppercase text-dark">Cart</h1>
            <div class="breadcrumbs">
              <span class="item">
                <a href="/index">Home ></a>
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
            <div class="row d-flex text-uppercase">
              <h3 class="cart-title col-lg-5 pb-4">Product</h3>
              <h3 class="cart-title col-lg-3 pb-3">Quantity</h3>
              <h3 class="cart-title col-lg-4 pb-3">Price</h3>
            </div>
          </div>
          {{-- @if(Helper::getAllProductFromCart()->count()) --}}
          <form>
          <div class="cart-item border-top border-bottom ">
            <div class="row align-items-center"> 
              <div class="col-lg-5 col-md-4">
                <div class="cart-info d-flex flex-wrap align-items-center mb-4">
                  <div class="col-lg-5">
                    <div class="card-image">
                      <img src="{{ asset('frontend/images/cart-item1.jpg') }}" alt="cloth" class="img-fluid">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="card-detail ps-3">
                      <h3 class="card-title text-uppercase">
                        <a href="#">Iphone 13</a>
                      </h3>
                      <div class="card-price">
                        <span class="money text-primary" data-currency-usd="$1200.00">26.500.000</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-5 col-md-6">
                <div class="row d-flex">
                  <div class="col-md-6">
                    <div class="qty-field">
                      <div class="qty-number d-flex">
                     
                       
                          <label class="screen-reader-text" for="quantity_pro"></label>
                          <input type="number" id="quantity_pro1" class="input-text qty text" step="1" min="0" max="9999" name="" value="1" title="quantity" size="4" pattern="[0-9]*" inputmode="numeric">
                      
                      </div>
                      <div class="regular-price"></div>
                      <div class="quantity-output text-center bg-primary"></div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="total-price">
                      <span class="money text-primary">26.500.000</span>
                    </div>
                  </div>   
                </div>             
              </div>

              <div class="col-lg-1 col-md-1" style="padding-left: 35px;">
                <div class="cart-remove">
                  <a href="#">
                    <svg class="close" width="28px">
                      <use xlink:href="#close"></use>
                    </svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
          {{-- @endif --}}
          <div class="cart-totals bg-grey padding-medium">
            
            <div class="button-wrap">
              <button class="btn btn-black btn-medium text-uppercase me-2 mb-3 btn-rounded-none">Update Cart</button>
              <button class="btn btn-black btn-medium text-uppercase me-2 mb-3 btn-rounded-none">Continue Shopping</button>
            </div>
          </div>
        </form> 
        </div>



        <div class="cart-checkout col-lg-4" style="padding-left: 20px;" >
          <div class="cart-totals bg-grey padding-medium" style="padding-top: 0em; padding-bottom:0em;">
            <h4 class="display-7 text-uppercase text-dark pb-4" style="margin-bottom: 8px;" >CHECK OUT YOUR ORDER</h4>
            <form>
           

              <div class="cart-totals bg-grey ">
   
                <div class="total-price ">
                  <table cellspacing="0" class="table text-uppercase">
                    <tbody>
                      
                      <tr class="order-total pt-2 pb-2 border-bottom">
                        <th>Total:</th>
                        <td data-title="Total">
                          <span class="price-amount amount text-primary ps-5">
                            <bdi>
                              <span class="price-currency-symbol">$</span>26.500.500 VNĐ</bdi>
                          </span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="form-group" style="padding-bottom: 20px">
                <label for="payment-method">Payment Method</label>
                <select id="payment-method" name="payment-method" class="form-control" required>
                  <option value="">Select payment method</option>
                  <option value="credit-card">Credit Card</option>
                  <option value="paypal">PayPal</option>
                </select>
              </div>

              <div class="form-group contact-info-card">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                      <span>Contact Info</span>
                      <a href="#" class="change-link">Change</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="form-group d-flex justify-content-between" style="padding-bottom: 23px">
                      <div>
                        <label for="name">Name</label>
                        <div id="name-display"  style="font-weight: bold;">Nguyễn Anh Dũng</div>
                      </div>
                      <div>
                        <label for="phone">Phone Number</label>
                        <div id="phone-display"  style="font-weight: bold;">09999999999</div>
                      </div>
                    </div>
                    <div class="form-group" style="padding-bottom: 12px">
                      <label for="address">Address</label>
                      <div id="address-display"  style="font-weight: bold;">123456 Hoàng Mai ,Hà Nội</div>
                    </div>
                    
                  </div>
                </div>
              </div>
            
              <button class="btn btn-black btn-medium text-uppercase me-2 mb-3 btn-rounded-none">Confirm Order</button>
              
            </form>
          </div>
        </div>

      </div>
    </div>
  </section> 