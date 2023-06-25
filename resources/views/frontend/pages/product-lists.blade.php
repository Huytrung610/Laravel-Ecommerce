@extends('frontend.layouts.master')
@section('title', env('APP_NAME') . ' || Product')
@section('main-content')
@include('frontend.layouts.header_fe')

  @php
    $svgContent = file_get_contents(public_path('frontend/svg/shop.svg'));
    echo $svgContent;
  @endphp


<section class="hero-section position-relative bg-light-blue padding-medium">
  <div class="hero-content">
      <div class="container">
          <div class="row">
              <div class="text-center padding-large no-padding-bottom">
                  <h1 class="display-2 text-uppercase text-dark">Shop</h1>
                  <div class="breadcrumbs">
                      <span class="item">
            <a href="index.html">Home ></a>
          </span>
                      <span class="item">Shop</span>
                  </div>
              </div>
          </div>
      </div>
  </div>
  
</section>
<div class="shopify-grid padding-large">
    <div class="container" style="font-size: 16px;margin-bottom: 3%;"  >
        {{-- <div class="row">    
           <div class="col-md-auto item-box" >
                <div class="title">
                    <a href="" title="All model">Tất cả </a>
                </div>
           </div>
       </div> --}}
       
       <div class="row">
        @foreach ($childCategories as $childCategory)
            <div class="col-md-auto item-box">
                <div class="title">
                    <a href="{{ route('product-list', ['slug' => $childCategory->slug]) }}" data-slug="{{ $childCategory->slug }}" data-id="{{ $childCategory->id }}" onclick="getProductListByCategory(event)">{{ $childCategory->title }}</a>
                </div>
            </div>
        @endforeach
    </div>
    
    
      </div>
    <form action="{{route('shop.filter')}}" method="POST" class="h-auto">
    @csrf
    <div class="container">
      <div class="row">
          <main class="col-md-9">
              <div class="product-content product-store d-flex justify-content-between flex-wrap">
                {{-- @if(count($productList)>0)
                    @foreach($productList as $product)
                        <div class="col-lg-4 col-md-6">
                            <div class="product-card position-relative pe-3 pb-3">
                                <a href="{{route('product-detail',$product->slug)}}">
                                    <div class="image-holder">
                                        <img src="{{$product->photo}}" alt="product-item" class="img-fluid">
                                    </div>
                                </a>
                                <div class="cart-concern position-absolute">
                                    <div class="cart-button d-flex">
                                        <div class="btn-left">
                                            <a href="#" class="btn btn-medium btn-black">Add to Cart</a>
                                            <svg class="cart-outline position-absolute">
                            <use xlink:href="#cart-outline"></use>
                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-detail d-flex justify-content-between pt-3 pb-3">
                                    <h3 class="card-title text-uppercase">
                                        <a href="#">{{$product->title}}</a>
                                    </h3>
                                    <span class="item-price text-primary">$980</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h4 class="text-warning" style="margin:100px auto;">There are no products.</h4>
                @endif --}}
              <nav class="navigation paging-navigation text-center padding-medium" role="navigation">
                  <div class="pagination loop-pagination d-flex justify-content-center align-items-center">
                      <a href="#">
                          <svg class="chevron-left pe-3">
              <use xlink:href="#chevron-left"></use>
            </svg>
                      </a>
                      <span aria-current="page" class="page-numbers current pe-3">1</span>
                      <a class="page-numbers pe-3" href="#">2</a>
                      <a class="page-numbers pe-3" href="#">3</a>
                      <a class="page-numbers pe-3" href="#">4</a>
                      <a class="page-numbers" href="#">5</a>
                      <a href="#">
                          <svg class="chevron-right ps-3">
              <use xlink:href="#chevron-right"></use>
            </svg>
                      </a>
                  </div>
              </nav>
          </main>
          <aside class="col-md-3">
              <div class="sidebar">
                  <div class="widget-menu">
                      <div class="widget-search-bar">
                          <form role="search" method="get" class="d-flex">
                              <input class="search-field" placeholder="Search" type="search">
                              <div class="search-icon bg-dark">
                                  <a href="#">
                                      <svg class="search text-light">
                    <use xlink:href="#search"></use>
                  </svg>
                                  </a>
                              </div>
                          </form>
                      </div>
                  </div>
                  <div class="widget-product-categories pt-5">
                      <h5 class="widget-title text-decoration-underline text-uppercase">Categories</h5>
                      <ul class="product-categories sidebar-list list-unstyled">
                          <li class="cat-item">
                              <a href="/collections/categories">All</a>
                          </li>
                          <li class="cat-item">
                              <a href="">iPhone</a>
                          </li>
                          <li class="cat-item">
                              <a href="">iPad</a>
                          </li>
                          <li class="cat-item">
                              <a href="">Macbook</a>
                          </li>
                          <li class="cat-item">
                              <a href="">Watches</a>
                          </li>
                          <li class="cat-item">
                              <a href="">Âm thanh</a>
                          </li>
                      </ul>
                    </div>
              </div>
          </aside>
      </div>
  </div>
</form>
</div>
@push('after_scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function getProductListByCategory(event) {
        event.preventDefault(); 

        var categoryID = $(event.target).data('id'); 
        $.ajax({
            url: '{{ route('get-product-list') }}', 
            method: 'GET',
            data: { category_id: categoryID }, 
            success: function(response) {
               
                if (response.length > 0) {
                    var productListHTML = '';
                    $.each(response, function(index, product) {
                        productListHTML += '<div class="col-lg-4 col-md-6">';
                        productListHTML += '<div class="product-card position-relative pe-3 pb-3">';
                        productListHTML += '<a href="' + product.url + '">';
                        productListHTML += '<div class="image-holder">';
                        productListHTML += '<img src="' + product.photo + '" alt="product-item" class="img-fluid">';
                        productListHTML += '</div>';
                        productListHTML += '</a>';
                        // productListHTML += '<div class="cart-concern position-absolute">';
                        // productListHTML += '<div class="cart-button d-flex">';
                        // productListHTML += '<div class="btn-left">';
                        // productListHTML += '<a href="#" class="btn btn-medium btn-black">Add to Cart</a>';
                        // productListHTML += '<svg class="cart-outline position-absolute">';
                        // productListHTML += '<use xlink:href="#cart-outline"></use>';
                        // productListHTML += '</svg>';
                        // productListHTML += '</div>';
                        // productListHTML += '</div>';
                        // productListHTML += '</div>';
                        productListHTML += '<div class="card-detail d-flex justify-content-between pt-3 " >';
                        productListHTML += '<h3 class="card-title text-uppercase">';
                        productListHTML += '<a href="#">' + product.title + '</a>';
                        productListHTML += '</h3>';

                        productListHTML += '</div>';
                        productListHTML += '<span class="item-price text-primary" style="font-size:19px;">' + product.price + ' ₫</span>';
                        
                        productListHTML += '</div>';
                        productListHTML += '</div>';
                    });
                    $('.product-content').html(productListHTML); 
                } else {
                    $('.product-content').html('<h4 class="text-warning" style="margin:100px auto;">There are no products.</h4>'); 
                }
            },
            error: function(xhr, status, error) {
                console.log(error); 
            }
        });
    }
</script>

  
@endpush
