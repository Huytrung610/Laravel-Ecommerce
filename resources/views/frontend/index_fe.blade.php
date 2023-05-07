@extends('frontend.layouts.master')
@section('title', env('APP_NAME') . ' || INDEX')
@section('main-content')


  @php
    $svgContent = file_get_contents(public_path('frontend/svg/index.svg'));
    echo $svgContent;
  @endphp

<div class="search-popup">
    <div class="search-popup-container">
        <form role="search" method="get" class="search-form" action="">
            <input type="search" id="search-form" class="search-field" placeholder="Type and press enter" value="" name="s" />
            <button type="submit" class="search-submit"><svg class="search"><use xlink:href="#search"></use></svg></button>
        </form>

        <h5 class="cat-list-title">Browse Categories</h5>

        <ul class="cat-list">
            <li class="cat-list-item">
                <a href="#" title="Mobile Phones">Mobile Phones</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Smart Watches">Smart Watches</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Headphones">Headphones</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Accessories">Accessories</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Monitors">Monitors</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Speakers">Speakers</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Memory Cards">Memory Cards</a>
            </li>
        </ul>

    </div>
</div>

<header id="header" class="site-header header-scrolled position-fixed text-black bg-light">
    <nav id="header-nav" class="navbar navbar-expand-lg px-3 mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="{{ asset('frontend/images/main-logo.png') }}" class="logo">
            </a>
            <button class="navbar-toggler d-flex d-lg-none order-3 p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <svg class="navbar-icon">
          <use xlink:href="#navbar-icon"></use>
        </svg>
      </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel">
                <div class="offcanvas-header px-4 pb-0">
                    <a class="navbar-brand" href="index.html">
                        <img  src="{{ asset('frontend/images/main-logo.png') }}" class="logo">
                    </a>
                    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close" data-bs-target="#bdNavbar"></button>
                </div>
                <div class="offcanvas-body">
                    <ul id="navbar" class="navbar-nav text-uppercase justify-content-end align-items-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link me-4 active" href="#billboard">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link me-4" href="#mobile-products">iPhone</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#ipad-products">iPad</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#smart-watches">Watch</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#desktop-mac">Macbook</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#yearly-sale">Khuyến mại</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#latest-blog">Tin Tức</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link me-4" href="#latest-news">Tin tức</a>
                        </li> -->

                        <li class="nav-item dropdown">
                            <a class="nav-link me-4 dropdown-toggle link-dark" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Pages</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="about.html" class="dropdown-item">About Us</a>
                                </li>
                                <li>
                                    <a href="blog.html" class="dropdown-item">Blog</a>
                                </li>
                                <li>
                                    <a href="shop.html" class="dropdown-item">Shop</a>
                                </li>
                                <li>
                                    <a href="cart.html" class="dropdown-item">Cart</a>
                                </li>
                                <li>
                                    <a href="checkout.html" class="dropdown-item">Checkout</a>
                                </li>
                                <li>
                                    <a href="single-post.html" class="dropdown-item">Single Post</a>
                                </li>
                                <li>
                                    <a href="single-product.html" class="dropdown-item">Single Product</a>
                                </li>
                                <li>
                                    <a href="contact.html" class="dropdown-item">Contact</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <div class="user-items ps-5">
                                <ul class="d-flex justify-content-end list-unstyled">
                                    <li class="search-item pe-3">
                                        <a href="#" class="search-button">
                                            <svg class="search">
                        <use xlink:href="#search"></use>
                      </svg>
                                        </a>
                                    </li>
                                    <li class="pe-3">
                                        <a href="#">
                                            <svg class="user">
                        <use xlink:href="#user"></use>
                      </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="cart.html">
                                            <svg class="cart">
                        <use xlink:href="#cart"></use>
                      </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
<section id="billboard" class="position-relative overflow-hidden bg-light-blue" style="padding: 100px 0px 20px; ;">
    <div class="swiper main-swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-6">
                            <div class="banner-content">
                                <h1 class="display-2 text-uppercase text-dark pb-5">Iphone 14 Pro Max</h1>
                                <a href="shop.html" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop Product</a>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="image-holder">
                                <img src="{{ asset('frontend/images/banner-image-iphone.png') }}" alt="banner">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <div class="row d-flex flex-wrap align-items-center">
                        <div class="col-md-6">
                            <div class="banner-content">
                                <h1 class="display-2 text-uppercase text-dark pb-5">Apple Watch Series 8</h1>
                                <a href="shop.html" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop Product</a>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="image-holder">
                                <img src="{{ asset('frontend/images/banner-image-watch.png') }}" alt="banner">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-icon swiper-arrow swiper-arrow-prev">
        <svg class="chevron-left" style="height:100px">
      <use xlink:href="#chevron-left" />
    </svg>
    </div>
    <div class="swiper-icon swiper-arrow swiper-arrow-next">
        <svg class="chevron-right" style="height:100px">
      <use xlink:href="#chevron-right" />
    </svg>
    </div>
</section>



<section id="company-services" class="padding-large">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 pb-3">
                <div class="icon-box d-flex">
                    <div class="icon-box-icon pe-3 pb-3">
                        <svg class="cart-outline">
              <use xlink:href="#cart-outline" />
            </svg>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="card-title text-uppercase text-dark">Free delivery</h3>
                        <p>Áp dụng với đơn hàng trên 10 triệu </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-3">
                <div class="icon-box d-flex">
                    <div class="icon-box-icon pe-3 pb-3">
                        <svg class="quality">
              <use xlink:href="#quality" />
            </svg>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="card-title text-uppercase text-dark">Quality guarantee</h3>
                        <p>Sản phẩm chính hãng 100%, là nhà phân phối độc quyền của Apple</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-3">
                <div class="icon-box d-flex">
                    <div class="icon-box-icon pe-3 pb-3">
                        <svg class="price-tag">
              <use xlink:href="#price-tag" />
            </svg>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="card-title text-uppercase text-dark">Daily offers</h3>
                        <p>Sản phẩm mới luôn được cập nhật theo thị trường</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-3">
                <div class="icon-box d-flex">
                    <div class="icon-box-icon pe-3 pb-3">
                        <svg class="shield-plus">
              <use xlink:href="#shield-plus" />
            </svg>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="card-title text-uppercase text-dark">100% secure payment</h3>
                        <p>Đảm bảo độ bảo mật thông tin khách hàng</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="mobile-products" class="product-store position-relative padding-large no-padding-top">
    <div class="container">
        <div class="row">
            <div class="display-header d-flex justify-content-between pb-3">
                <h2 class="display-7 text-dark text-uppercase">Mobile Products</h2>
                <div class="btn-right">
                    <a href="shop.html" class="btn btn-medium btn-normal text-uppercase">Go to Shop</a>
                </div>
            </div>
            <div class="swiper product-swiper">
                <div class="swiper-wrapper" >
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img src="{{ asset('frontend/images/item_1.png') }}" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 14 ProMax 128gb</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">28.000.000 VNĐ</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img  src="{{ asset('frontend/images/item_2.png') }}" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 14 Pro</a>
                                </h3>
                                <!-- <span class="item-price text-primary">$1100</span> -->
                            </div>
                            <h5 class="item-price text-primary">24.900.000 VNĐ</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img  src="{{ asset('frontend/images/item_1.png') }}"  alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 14 ProMax 128gb</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">28.000.000 VNĐ</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img src="{{ asset('frontend/images/item_2.png') }}"  alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 14 ProMax 128gb</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">28.000.000 VNĐ</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img src="{{ asset('frontend/images/item_1.png') }}"  alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 14 ProMax 128gb</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">28.000.000 VNĐ</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-pagination position-absolute text-center"></div>
</section>
<section id="smart-watches" class="product-store padding-large position-relative">
    <div class="container">
        <div class="row">
            <div class="display-header d-flex justify-content-between pb-3">
                <h2 class="display-7 text-dark text-uppercase">Smart Watches</h2>
                <div class="btn-right">
                    <a href="shop.html" class="btn btn-medium btn-normal text-uppercase">Go to Shop</a>
                </div>
            </div>
            <div class="swiper product-watch-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="{{ asset('frontend/images/product-item6.jpg') }}"  alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Pink watch</a>
                                </h3>
                                <span class="item-price text-primary">$870</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img  src="{{ asset('frontend/images/product-item7.jpg') }}" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Heavy watch</a>
                                </h3>
                                <span class="item-price text-primary">$680</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="{{ asset('frontend/images/product-item8.jpg') }}" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">spotted watch</a>
                                </h3>
                                <span class="item-price text-primary">$750</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="{{ asset('frontend/images/product-item9.jpg') }}" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">black watch</a>
                                </h3>
                                <span class="item-price text-primary">$650</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="{{ asset('frontend/images/product-item10.jpg') }}" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">black watch</a>
                                </h3>
                                <span class="item-price text-primary">$750</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-pagination position-absolute text-center"></div>
</section>
<section id="yearly-sale" class="bg-light-blue overflow-hidden mt-5 padding-xlarge" style="background-image: url('{{ asset('frontend/images/single-image1.png') }}');background-position: right; background-repeat: no-repeat;">
    <div class="row d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-sm-12">
            <div class="text-content offset-4 padding-medium" style="margin-left: 20%;">
                <h3>5% off tất cả các sản phẩm mừng ngày sinh nhật của Store</h3>
                <h2 class="display-2 pb-5 text-uppercase text-dark">Birthday Party</h2>
                <a href="shop.html" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop Sale</a>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">

        </div>
    </div>
</section>
<section id="latest-blog" class="padding-large">
    <div class="container">
        <div class="row">
            <div class="display-header d-flex justify-content-between pb-3">
                <h2 class="display-7 text-dark text-uppercase">Tin tức công nghệ</h2>
                <div class="btn-right">
                    <a href="blog.html" class="btn btn-medium btn-normal text-uppercase">Read Blog</a>
                </div>
            </div>
            <div class="post-grid d-flex flex-wrap justify-content-between">
                <div class="col-lg-4 col-sm-12">
                    <div class="card border-none me-3">
                        <div class="card-image">
                            <img src="{{ asset('frontend/images/post-item1.jpg') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="card-body text-uppercase">
                        <div class="card-meta text-muted">
                            <span class="meta-date">feb 22, 2023</span>
                            <span class="meta-category">- Gadgets</span>
                        </div>
                        <h3 class="card-title">
                            <a href="#">máy chơi game "quốc dân" của năm 2023 ra mắt</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card border-none me-3">
                        <div class="card-image">
                            <img  src="{{ asset('frontend/images/post-item2.jpg') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="card-body text-uppercase">
                        <div class="card-meta text-muted">
                            <span class="meta-date">feb 25, 2023</span>
                            <span class="meta-category">- Technology</span>
                        </div>
                        <h3 class="card-title">
                            <a href="#">Tai nghe dành cho dân thể thao</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card border-none me-3">
                        <div class="card-image">
                            <img src="{{ asset('frontend/images/post-item3.jpg') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="card-body text-uppercase">
                        <div class="card-meta text-muted">
                            <span class="meta-date">feb 22, 2023</span>
                            <span class="meta-category">- Camera</span>
                        </div>
                        <h3 class="card-title">
                            <a href="#">Top 10 Máy ảnh mini được đánh giá cao thời điểm hiện tại</a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="testimonials" class="position-relative">
    <div class="container">
        <div class="row">
            <div class="review-content position-relative">
                <div class="swiper-icon swiper-arrow swiper-arrow-prev position-absolute d-flex align-items-center">
                    <svg class="chevron-left">
            <use xlink:href="#chevron-left" />
          </svg>
                </div>
                <div class="swiper testimonial-swiper">
                    <div class="quotation text-center">
                        <svg class="quote">
              <use xlink:href="#quote" />
            </svg>
                    </div>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide text-center d-flex justify-content-center">
                            <div class="review-item col-md-10">
                                <i class="icon icon-review"></i>
                                <blockquote>“Tư vấn tận tình, dịch vụ bảo hành cực tốt, giao hàng nhanh, nếu có cơ hội sẽ ủng hộ cửa hàng thêm”</blockquote>
                                <div class="rating">
                                    <svg class="star star-fill">
                    <use xlink:href="#star-fill"></use>
                  </svg>
                                    <svg class="star star-fill">
                    <use xlink:href="#star-fill"></use>
                  </svg>
                                    <svg class="star star-fill">
                    <use xlink:href="#star-fill"></use>
                  </svg>
                                    <svg class="star star-half">
                    <use xlink:href="#star-half"></use>
                  </svg>
                                    <svg class="star star-empty">
                    <use xlink:href="#star-empty"></use>
                  </svg>
                                </div>
                                <div class="author-detail">
                                    <div class="name text-dark text-uppercase pt-2">Nguyễn Hằng</div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide text-center d-flex justify-content-center">
                            <div class="review-item col-md-10">
                                <i class="icon icon-review"></i>
                                <blockquote>“Iphone 14 promax vừa mới lên báo mở bán vậy mà mấy hôm sau shop đã bán rồi, tốc độ nhập hàng nhanh nhất Việt Nam”</blockquote>
                                <div class="rating">
                                    <svg class="star star-fill">
                    <use xlink:href="#star-fill"></use>
                  </svg>
                                    <svg class="star star-fill">
                    <use xlink:href="#star-fill"></use>
                  </svg>
                                    <svg class="star star-fill">
                    <use xlink:href="#star-fill"></use>
                  </svg>
                                    <svg class="star star-half">
                    <use xlink:href="#star-half"></use>
                  </svg>
                                    <svg class="star star-empty">
                    <use xlink:href="#star-empty"></use>
                  </svg>
                                </div>
                                <div class="author-detail">
                                    <div class="name text-dark text-uppercase pt-2">Quân Hoàng</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-icon swiper-arrow swiper-arrow-next position-absolute d-flex align-items-center">
                    <svg class="chevron-right">
            <use xlink:href="#chevron-right" />
          </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-pagination"></div>
</section>