@extends('frontend.layouts.master')

@section('title', env('APP_NAME') . ' || Product Detail')

@section('main-content')
@include('frontend.layouts.header_fe')

@php
    $svgContent = file_get_contents(public_path('frontend/svg/product.svg'));
    echo $svgContent;
@endphp

<section id="selling-product" class="single-product tw-py-20">
    <form class="container" action="{{route('single-add-to-cart')}}" method="POST">
        @csrf
        <div class="mt-5 tw-flex tw-gap-8">
            @include('frontend.pages.product-detail.album-product')
            <div class="product-detail-info-wrapper">
                <div class="product-info tw-flex tw-flex-col tw-gap-8">
                    <div class="element-header">
                        <h2 itemprop="name" class="product-main-title display-7 tw-font-bold tw-text-2xl">{{$productDetail->title}}</h2>
                        <input type="hidden" class="productName--hidden" value="{{$productDetail->title}}">
                    </div>
                    <div class="detail-product__summary">
                        {!! htmlspecialchars_decode($productDetail->summary) !!}
                    </div>
                    @if($productDetail->brand)
                        <div class="detail-product__brand tw-flex tw-items-center tw-gap-3">
                            <h3 class="tw-font-bold">Brand:</h3>
                            <span>{{$productDetail->brand->name}}</span>
                        </div>
                    @endif
                    @include('frontend.sections.attribute-product')
                    </div>
                    <div>
                        <div class="cart-wrap">
                            <div class="product-price pt-3 pb-3">
                                <strong class="main-price tw-text-sm tw-font-bold display-6 price-product">{{ number_format($productDetail->price, 0, ',', '.') }}đ</strong> 
                            </div>
                            <div class="product-quantity">
                                {{-- <div class="stock-number text-dark stock-product"></div> --}}
                                <div class="container text-center" style="padding: 0px">
                                    <div class="row row-cols-auto">
                                      <div class="col"><h5>IN STOCK :</h5></div>
                                      <div class="col stock-number text-dark stock-product"></div>
                                    </div>
                                </div>
                                <div class="stock-button-wrap pt-3 tw-flex tw-gap-4">
                                    <div class="input-group product-qty">
                                        <span class="input-group-btn">
                                            <button type="button" class="quantity-left-minus btn btn-number"  data-type="minus" data-field="quant[1]">
                                            -
                                            </button>
                                        </span>
                                        <input type="text" id="quantity" name="quant[1]" class="form-control input-number tw-text-2xl tw-font-bold" data-min="1"
                                            data-max="1000" value="1">
                                        <span class="input-group-btn">
                                            <button type="button" class="quantity-right-plus btn btn-number" data-type="plus" data-field="quant[1]">
                                                +
                                            </button>
                                        </span>
                                    </div>
                                    @guest
                                        <div class="qty-button d-flex flex-wrap btn-add-to-cart">
                                            <button type="button" name="add-to-cart" class="btn btn-black btn-medium text-uppercase mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                Add to cart
                                              </button>
                                        </div>
                                        @include('frontend.popup.sign-up-popup')
                                    @else
                                        <div class="qty-button d-flex flex-wrap">
                                            <button type="submit" name="add-to-cart" value="1269" class="btn btn-black text-uppercase">Add to cart</button>
                                        </div>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" class="attributeCatalogue" name="attribute" value={{ json_encode($productDetail->attributes) }}>
        <input type="hidden" class="productSlug--hidden" name="product_variant_slug"  value="{{ url('product-detail/' . $productDetail->slug) }}">
    </form>
</section>
<section class="product-info-tabs">
    <div class="container">
        <div class="row">
            <div class="tabs-listing">
                <nav>
                    <div class="nav nav-tabs d-flex flex-wrap justify-content-center" id="nav-tab" role="tablist">
                        <button class="nav-link active pe-5 tw-text-black !tw-text-base" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Product Description</button>
                        <button class="nav-link pe-5 tw-text-black !tw-text-base" id="nav-information-tab" data-bs-toggle="tab" data-bs-target="#nav-information" type="button" role="tab" aria-controls="nav-information" aria-selected="false">Thông tin bổ sung</button>
                        {{-- <button class="nav-link text-uppercase pe-5" id="nav-review-tab" data-bs-toggle="tab" data-bs-target="#nav-review" type="button" role="tab" aria-controls="nav-review" aria-selected="false">Reviews</button> --}}
                    </div>
                </nav>
                <div class="tab-content tw-px-11 tw-shadow" id="nav-tabContent">
                    <div class="tab-pane fade show active border-top border-bottom padding-small" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="description">{!! html_entity_decode($productDetail->description)!!}</div>
                    </div>
                    <div class="tab-pane fade border-top border-bottom padding-small" id="nav-information" role="tabpanel" aria-labelledby="nav-information-tab">
                        <p>Các thông tin Apple đảm bảo ( Pháp lý)</p>
                        <ul style="list-style-type:disc;" class="list-unstyled ps-4">
                            Apple Watch Series 7 tương thích với iPhone 6s hoặc các phiên bản cao hơn sử dụng iOS 15 hoặc các bản cập nhật cao hơn. Số đo từ ứng dụng Ôxi Trong Máu không được dùng cho mục đích y tế, kể cả tự chẩn đoán hoặc xin ý kiến bác sĩ và chỉ được thiết kế cho
                            hoạt động luyện tập thông thường và mục đích chăm sóc sức khỏe. Ứng dụng ECG chỉ khả dụng trên Apple Watch Series 4 và các phiên bản cao hơn (không bao gồm Apple Watch SE) sử dụng iOS và watchOS phiên bản mới nhất. Truy
                            cập để biết thông tin về khả năng tương thích. Không được sử dụng ECG cho người dưới 22 tuổi. Với ứng dụng ECG, Apple Watch có khả năng tạo ra kết quả ECG tương tự như điện tâm đồ một đạo trình. Tính năng thông báo nhịp
                            tim không đều chỉ khả dụng trên watchOS cũng như iOS phiên bản mới nhất. Tính năng này không dành cho người dưới 22 tuổi và không được thiết kế dành cho người từng có kết quả chẩn đoán bị rung nhĩ (Afib).
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('after_scripts')
<link href="{{ asset('css/product-detail.css') }}" rel="stylesheet">
<script src="{{ mix('js/frontend/product-detail.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script>

</script>

@endpush

@endsection 