@extends('frontend.layouts.master')
@section('title', env('APP_NAME') . ' || Product Detail')
@section('main-content')
@include('frontend.layouts.header')

@php
    $svgContent = file_get_contents(public_path('frontend/svg/product.svg'));
    echo $svgContent;
  @endphp

<section id="selling-product" class="single-product padding-xlarge">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="product-preview mb-3">
                    <img alt="single-product" class="img-fluid"> 
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product-info">
                    <div class="element-header">

                        <h3 itemprop="name" class="display-7 text-uppercase">{{$productDetail->title}}</h3>

                     
                    </div>
                    <div class="product-price pt-3 pb-3">
                        <strong class="text-primary display-6 fw-bold">7.990.000 VNĐ</strong>
                    </div>
                    <p>{{strip_tags($productDetail->description)}}
                    </p>
                    <div class="cart-wrap padding-small">
                        <div class="color-options product-select">
                            <div class="color-toggle" data-option-index="0">
                                <h4 class="item-title text-uppercase text-dark text-decoration-underline">Color:</h4>
                                <ul class="select-list list-unstyled d-flex">
                                    <li class="select-item pe-3" data-val="Green" title="Green">
                                        <a href="#">Green</a>
                                <ul class="select-list list-unstyled d-flex product-color">
                                    <li class="select-item pe-3" data-val="Cream" title="Cream">
                                        <span class="cream active" data-color="#f4e9d4" data-pic="{{ asset('frontend/images/watch_cream_550.png') }}"></span>             
                                    </li>

                                    <li class="select-item pe-3" data-val="Green" title="Green">
                                        <span class="green" data-color="#badc58" data-pic="{{ asset('frontend/images/watch_green_550.png') }}"></span>
                                    </li>
                                    
                                    <li class="select-item pe-3" data-val="Mignight" title="Midnight">
                                        <span class="midnight" data-color="#000" data-pic="{{ asset('frontend/images/watch_midnight_550.png') }}"></span>
                                    </li>
                                    <li class="select-item" data-val="Blue" title="Blue">
                                        <span class="blue" data-color="#174c6f" data-pic="{{ asset('frontend/images/watch_blue_550.png') }}"></span>

                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-quantity">
                            <div class="stock-number text-dark">2 in stock</div>
                            <div class="stock-button-wrap pt-3">

                                <div class="input-group product-qty">
                                    <span class="input-group-btn">
                        <button type="button" class="quantity-left-minus btn btn-number"  data-type="minus" data-field="">
                          -
                        </button>
                    </span>
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                    <span class="input-group-btn">
                        <button type="button" class="quantity-right-plus btn btn-number" data-type="plus" data-field="">
                            +
                        </button>
                    </span>
                                </div>
                                <div class="qty-button d-flex flex-wrap pt-3">
                                    <button type="submit" class="btn btn-primary btn-medium text-uppercase me-3 mt-3">Buy now</button>
                                    <button type="submit" name="add-to-cart" value="1269" class="btn btn-black btn-medium text-uppercase mt-3">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="meta-product py-2">
                        <div class="meta-item d-flex align-items-baseline">
                            <h4 class="item-title no-margin pe-2">SKU:</h4>
                            <ul class="select-list list-unstyled d-flex">
                                <li data-value="S" class="select-item">1223</li>
                            </ul>
                        </div>
                        <div class="meta-item d-flex align-items-baseline">
                            <h4 class="item-title no-margin pe-2">Category:</h4>
                            <ul class="select-list list-unstyled d-flex">
                                <li data-value="S" class="select-item">
                                    <a href="#">Watch</a>,
                                </li>
                                <li data-value="S" class="select-item">
                                    <a href="#"> Screen touch</a>,
                                </li>
                            </ul>
                        </div>
                        <div class="meta-item d-flex align-items-baseline">
                            <h4 class="item-title no-margin pe-2">Tags:</h4>
                            <ul class="select-list list-unstyled d-flex">
                                <li data-value="S" class="select-item">
                                    <a href="#">Classic</a>,
                                </li>
                                <li data-value="S" class="select-item">
                                    <a href="#"> Modern</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-info-tabs">
    <div class="container">
        <div class="row">
            <div class="tabs-listing">
                <nav>
                    <div class="nav nav-tabs d-flex flex-wrap justify-content-center" id="nav-tab" role="tablist">
                        <button class="nav-link active text-uppercase pe-5" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Mô tả sản phẩm </button>
                        <button class="nav-link text-uppercase pe-5" id="nav-information-tab" data-bs-toggle="tab" data-bs-target="#nav-information" type="button" role="tab" aria-controls="nav-information" aria-selected="false">Thông tin bổ sung</button>
                        {{-- <button class="nav-link text-uppercase pe-5" id="nav-review-tab" data-bs-toggle="tab" data-bs-target="#nav-review" type="button" role="tab" aria-controls="nav-review" aria-selected="false">Reviews</button> --}}
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active border-top border-bottom padding-small" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <p>Product Description</p>
                        <p>Tính năng nổi bật</p>
                        <ul style="list-style-type:disc;" class="list-unstyled ps-4">
                            <li>Màn hình Retina Luôn Bật với diện tích lớn hơn Series 6 gần 20%, giúp bạn xem và sử dụng mọi thứ dễ dàng hơn</li>
                            <li>Mặt trước bằng thủy tinh chống nứt tốt nhất trên Apple Watch, đạt chuẩn chống bụi IP6X và thiết kế chống thấm nước khi bơi lội</li>
                            <li>Đo mức ôxi trong máu bằng cảm biến và ứng dụng mạnh mẽ</li>
                            <li>Đo điện tâm đồ (ECG) mọi lúc, mọi nơi </li>
                            <li>Nhận thông báo nhịp tim nhanh hay chậm và thông báo nhịp tim không đều </li>
                        </ul>
                        <!-- <p>Các thông tin Apple đảm bảo ( Pháp lý)</p>
                        <ul style="list-style-type:disc;" class="list-unstyled ps-4">aaa</ul> -->
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
    {{-- <script> 
    // hành động thay đổi ảnh khi click vào color
    $(document).ready(function() {
    $(".product-color span").click(function() {
        $(".product-color span").removeClass("active");
        $(this).addClass("active");
        var imageUrl = $(this).attr("data-pic");
        $(".img-fluid").attr("src", imageUrl);
    });
});
</script> --}}
    <script>
        // hành động active màu đầu tiên mỗi khi load lại trang hay vào trang + hành động thay đổi ảnh khi click vào color tương ứng

    $(document).ready(function() {
    // Lấy URL ảnh của màu đầu tiên và đặt nó vào thuộc tính src của ảnh
        var firstColorImageUrl = $(".product-color span:first-child").attr("data-pic");
        $(".img-fluid").attr("src", firstColorImageUrl);

    // Xử lý sự kiện click cho các phần tử span
     $(".product-color span").click(function() {
         $(".product-color span").removeClass("active");
         $(this).addClass("active");
         var imageUrl = $(this).attr("data-pic");
         $(".img-fluid").attr("src", imageUrl);
        });
    });

    $(window).on("load", function() {
     // Lấy URL ảnh của màu đầu tiên và đặt nó vào thuộc tính src của ảnh
     var firstColorImageUrl = $(".product-color span:first-child").attr("data-pic");
         $(".img-fluid").attr("src", firstColorImageUrl);
    });
    </script>
@endpush
