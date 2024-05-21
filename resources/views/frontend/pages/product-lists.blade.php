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
  <div class="container">
    <div class="search-product-container tw-flex tw-justify-end">
        <form class="searh-product-form tw-min-w-72">   
          <label for="default-search" class="tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 tw-sr-only dark:tw-text-white">Search</label>
          <div class="tw-relative">
              <div class="tw-absolute tw-inset-y-0 tw-start-0 tw-flex tw-items-center tw-ps-3 tw-pointer-events-none">
                  <svg class="tw-w-4 tw-h-4 tw-text-gray-500 dark:tw-text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                  </svg>
              </div>
              <input type="search" id="product-search" class="tw-block tw-w-full tw-p-4 tw-ps-10 tw-text-sm tw-text-gray-900 tw-border tw-border-gray-300 tw-rounded-lg tw-bg-gray-50 focus:tw-ring-blue-500 focus:border-blue-500 dark:tw-bg-gray-700 dark:tw-border-gray-600 dark:tw-placeholder-gray-400 dark:tw-text-white dark:focus:tw-ring-blue-500 dark:focus:tw-border-blue-500" placeholder="Search products,..." required />
              <button type="submit" class="product-search-btn tw-text-third tw-absolute tw-end-2.5 tw-bottom-2.5 tw-bg-secondary hover:tw-opacity-80 focus:tw-ring-4 focus:tw-outline-none focus:tw-ring-blue-300 tw-font-medium tw-rounded-lg tw-text-sm tw-px-4 tw-py-2 dark:tw-bg-blue-600 dark:hover:tw-bg-blue-700 dark:focus:tw-ring-blue-800">Search</button>
          </div>
        </form>
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
  <input type="hidden" id="category-slug" value="{{ $category->slug }}">

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
<script src="{{ mix('js/frontend/product-list.js') }}"></script>

  <script>
     $('#product-search').on('input', function() {
        var query = $(this).val();

        $.ajax({
            url: "{{ route('search-products') }}",
            type: "GET",
            data: { query: query },
            success: function(data) {
                $('.product-list-wrapper').empty();

                if (data.length > 0) {
                    $.each(data, function(index, product) {
                        var productHTML = `
                            <div class="product-col">
                                <div class="item_product_main">
                                    <div class="variants product-action tw-flex tw-flex-col tw-gap-2">
                                        <div class="product-thumbnail">
                                            <a class="image_thumb" href="{{ url('/product-detail') }}/${product.slug}" title="">
                                                <span class="imgWrap pt_100">
                                                    <div class="imgWrap-item tw-w-full tw-h-[320px]">
                                                        <img class="lazyload loaded tw-rounded-2xl tw-h-full" src="${product.photo}" alt="" data-was-processed="true">
                                                    </div>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="product-info tw-flex tw-flex-col tw-items-center tw-gap-1">
                                            <h3 class="product-name tw-font-bold tw-text-lg">
                                                <a href="{{ url('/product-detail') }}/${product.slug}" class="hover:tw-text-yellow-500" title="">${product.title}</a>
                                            </h3>
                                            <div class="price-box">
                                                <span class="price-title">Giá từ: <span class="min-price tw-font-bold">${new Intl.NumberFormat().format(product.price)}đ</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        $('#product-list').append(productHTML);
                    });
                } else {
                    $('#product-list').html('<p>No products found.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
            }
        });
    });
  </script>
@endpush

