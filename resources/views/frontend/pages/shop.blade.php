@extends('frontend.layouts.master')
@section('title', env('APP_NAME') . ' || Product')
@section('main-content')
@include('frontend.layouts.header')

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
        <div class="row">
          
           <div class="col-md-auto item-box" >
                <div class="title">
                    <a href="" title="All model">Tất cả </a>
                </div>
           </div>
     
          <div class="col-md-auto item-box">
            <div class="title">
                <a href="/iphone-14-series" title="Hiển thị sản phẩm trong danh mục iPhone 14 series">iPhone14 series </a>
            </div>
          </div>

          <div class="col-md-auto item-box">
            <div class="title">
                <a href="/iphone-13-series" title="Hiển thị sản phẩm trong danh mục iPhone 13 series">iPhone 13 series </a>
            </div>
          </div>

          <div class="col-md-auto item-box">
            <div class="title">
                <a href="/iphone-12-series" title="Hiển thị sản phẩm trong danh mục iPhone 12 series">iPhone 12 series </a>
            </div>
          </div>

        </div>
      </div>

  <div class="container">
      <div class="row">
          <main class="col-md-9">
              {{-- <div class="filter-shop d-flex justify-content-between">
                  <div class="showing-product">
                      
                  </div>
                  <div class="sort-by">
                      <select id="input-sort" class="form-control" data-filter-sort="" data-filter-order="">
            <option value="">Default sorting</option>
            <option value="">Name (A - Z)</option>
            <option value="">Name (Z - A)</option>
            <option value="">Price (Low-High)</option>
            <option value="">Price (High-Low)</option>
            <option value="">Rating (Highest)</option>
            <option value="">Rating (Lowest)</option>
            <option value="">Model (A - Z)</option>
            <option value="">Model (Z - A)</option>   
          </select>
                  </div>
              </div> --}}

              

              <div class="product-content product-store d-flex justify-content-between flex-wrap">
                  <div class="col-lg-4 col-md-6">
                      <div class="product-card position-relative pe-3 pb-3">
                          <div class="image-holder">
                              <img src="{{ asset('frontend/images/product-item1.jpg') }}" alt="product-item" class="img-fluid">
                          </div>
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
                                  <a href="#">Iphone 10</a>
                              </h3>
                              <span class="item-price text-primary">$980</span>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                      <div class="product-card position-relative pe-3 pb-3">
                          <div class="image-holder">
                              <img src="{{ asset('frontend/images/product-item2.jpg') }}"" alt="product-item" class="img-fluid">
                          </div>
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
                          <div class="card-detail d-flex justify-content-between pt-3">
                              <h3 class="card-title text-uppercase">
                                  <a href="#">Iphone 11</a>
                              </h3>
                              <span class="item-price text-primary">$110</span>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                      <div class="product-card position-relative pe-3 pb-3">
                          <div class="image-holder">
                              <img src="{{ asset('frontend/images/product-item3.jpg') }}" alt="product-item" class="img-fluid">
                          </div>
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
                          <div class="card-detail d-flex justify-content-between pt-3">
                              <h3 class="card-title text-uppercase">
                                  <a href="#">Iphone 8</a>
                              </h3>
                              <span class="item-price text-primary">$780</span>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                      <div class="product-card position-relative pe-3 pb-3">
                          <div class="image-holder">
                              <img src="{{ asset('frontend/images/product-item4.jpg') }}" alt="product-item" class="img-fluid">
                          </div>
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
                          <div class="card-detail d-flex justify-content-between pt-3">
                              <h3 class="card-title text-uppercase">
                                  <a href="#">Iphone 13</a>
                              </h3>
                              <span class="item-price text-primary">$1500</span>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                      <div class="product-card position-relative pe-3 pb-3">
                          <div class="image-holder">
                              <img src="{{ asset('frontend/images/product-item6.jpg') }}" alt="product-item" class="img-fluid">
                          </div>
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
                          <div class="card-detail d-flex justify-content-between pt-3">
                              <h3 class="card-title text-uppercase">
                                  <a href="#">Pink watch</a>
                              </h3>
                              <span class="item-price text-primary">$870</span>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                      <div class="product-card position-relative pe-3 pb-3">
                          <div class="image-holder">
                              <img src="{{ asset('frontend/images/product-item7.jpg') }}" alt="product-item" class="img-fluid">
                          </div>
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
                          <div class="card-detail d-flex justify-content-between pt-3">
                              <h3 class="card-title text-uppercase">
                                  <a href="#">Heavy watch</a>
                              </h3>
                              <span class="item-price text-primary">$680</span>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                      <div class="product-card position-relative pe-3 pb-3">
                          <div class="image-holder">
                              <img src="{{ asset('frontend/images/product-item8.jpg') }}" alt="product-item" class="img-fluid">
                          </div>
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
                          <div class="card-detail d-flex justify-content-between pt-3">
                              <h3 class="card-title text-uppercase">
                                  <a href="#">spotted watch</a>
                              </h3>
                              <span class="item-price text-primary">$750</span>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                      <div class="product-card position-relative pe-3 pb-3">
                          <div class="image-holder">
                              <img src="{{ asset('frontend/images/product-item10.jpg') }}" alt="product-item" class="img-fluid">
                          </div>
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
                          <div class="card-detail d-flex justify-content-between pt-3">
                              <h3 class="card-title text-uppercase">
                                  <a href="#">Black Watch</a>
                              </h3>
                              <span class="item-price text-primary">$750</span>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                      <div class="product-card position-relative pe-3 pb-3">
                          <div class="image-holder">
                              <img src="{{ asset('frontend/images/product-item5.jpg') }}" alt="product-item" class="img-fluid">
                          </div>
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
                          <div class="card-detail d-flex justify-content-between pt-3">
                              <h3 class="card-title text-uppercase">
                                  <a href="#">Iphone 12</a>
                              </h3>
                              <span class="item-price text-primary">$1300</span>
                          </div>
                      </div>
                  </div>
              </div>
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
                  <!-- <div class="widget-product-tags pt-3">
          <h5 class="widget-title text-decoration-underline text-uppercase">Tags</h5>
          <ul class="product-tags sidebar-list list-unstyled">
            <li class="tags-item">
              <a href="">White</a>
            </li>
            <li class="tags-item">
              <a href="">Cheap</a>
            </li>
            <li class="tags-item">
              <a href="">Mobile</a>
            </li>
            <li class="tags-item">
              <a href="">Modern</a>
            </li>
          </ul>
        </div> -->
                  <!-- <div class="widget-product-brands pt-3">
          <h5 class="widget-title text-decoration-underline text-uppercase">Brands</h5>
          <ul class="product-tags sidebar-list list-unstyled">
            <li class="tags-item">
              <a href="">Apple</a>
            </li>
            <li class="tags-item">
              <a href="">Samsung</a>
            </li>
            <li class="tags-item">
              <a href="">Huwai</a>
            </li>
          </ul>
        </div> -->
                  <!-- <div class="widget-price-filter pt-3">
          <h5 class="widget-titlewidget-title text-decoration-underline text-uppercase">Filter By Price</h5>
          <ul class="product-tags sidebar-list list-unstyled">
            <li class="tags-item">
              <a href="">Less than $10</a>
            </li>
            <li class="tags-item">
              <a href="">$10- $20</a>
            </li>
            <li class="tags-item">
              <a href="">$20- $30</a>
            </li>
            <li class="tags-item">
              <a href="">$30- $40</a>
            </li>
            <li class="tags-item">
              <a href="">$40- $50</a>
            </li>
          </ul>
        </div> -->
              </div>
          </aside>
      </div>
  </div>
</div>