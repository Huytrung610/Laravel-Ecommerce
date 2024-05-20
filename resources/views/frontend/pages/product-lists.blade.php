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
              <div class="text-center no-padding-bottom tw-flex tw-flex-col tw-gap-4">
                  <h1 class="tw-text-2xl tw-font-bold text-uppercase text-dark product-category__title">{{ $category->title }}</h1>
                  <div class="breadcrumbs">
                      <span class="product-category__summary">{!! htmlspecialchars_decode($category->summary) !!}</span>
                  </div>
              </div>
          </div>
      </div>
  </div>
  
</section>
<div class="shopify-grid tw-bg-gray-100">
  <div class="container" style="font-size: 16px;margin-bottom: 3%;"  >
    <div class="d-flex mb-3">
       <div class="ms-auto p-2">
          <div class="input-group">
              <div class="form-outline">
                <input type="search" id="form1" class="form-control" />
              </div>
                 <button type="button" class="btn btn-primary" onclick="searchProducts()">
                     <i class="fas fa-search"></i>
                 </button>              
          </div>
        </div>
    </div>

    <div class="product-list-container tw-flex tw-flex-col tw-gap-y-11">
      <div class="product-list-wrapper tw-grid tw-grid-cols-4 tw-gap-x-3.5 tw-gap-y-9">
        @foreach($productList as $product)
          <div class="product-col">
            <div class="item_product_main">
                <div class="variants product-action tw-flex tw-flex-col tw-gap-2">
                    <div class="product-thumbnail">
                        <a class="image_thumb" href="{{ route('product-detail', ['slug' => $product->slug]) }}" title="">
                          <span class="imgWrap pt_100">
                            <div class="imgWrap-item tw-w-full tw-h-[320px]">
                                <img class="lazyload loaded tw-rounded-2xl tw-h-full" src="{{ $product->photo }}" alt="" data-was-processed="true">
                            </div>
                          </span>
                        </a>
                    </div>
                    <div class="product-info tw-flex tw-flex-col tw-items-center tw-gap-1">
                      <h3 class="product-name tw-font-bold tw-text-lg"><a href="{{ route('product-detail', ['slug' => $product->slug]) }}" class="hover:tw-text-yellow-500" title="">{{ $product->title }}</a></h3>
                      @php
                        $minPrice = $product->product_variants()->min('price') ?? $product->price;
                        $formatted_minPrice = number_format($minPrice, 0, ',', '.');
                      @endphp
                      <div class="price-box">
                          <span class="price-title">Giá từ: <span class="min-price tw-font-bold"> {{ $formatted_minPrice }}đ</span></span>
                      </div>
                    </div>
                </div>
            </div>
          </div>
          @endforeach
      </div>
      {!! $productList->links() !!}
    </div>
  </div>

    <form action="{{route('shop.filter')}}" method="POST" class="h-auto">
      @csrf
      <div class="container">
        <div class="row">
            <main class="">
                <div class="product-content product-store d-flex  flex-wrap">
            </main>
        </div>
    </div>
  </form>
</div>
@include('frontend.sections.company-services')
@push('after_scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
{{-- <script>
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

    function searchProducts() {
  var searchValue = $('#form1').val(); // Lấy giá trị từ ô input search

  $.ajax({
    url: '{{ route('search-products') }}',
    method: 'GET',
    data: { search: searchValue },
    success: function(response) {
      // Xử lý dữ liệu phản hồi từ server
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
        $('.product-content').html('<h4 class="text-warning" style="margin:100px auto;">No products found.</h4>');
      }
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });
}

</script> --}}

@endpush

