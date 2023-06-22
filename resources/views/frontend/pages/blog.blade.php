@extends('frontend.layouts.master')

@section('title', env('APP_NAME') . ' || Blog')

@section('main-content')

@include('frontend.layouts.header_fe')


@php
    $svgContent = file_get_contents(public_path('frontend/svg/blog.svg'));
    echo $svgContent;
  @endphp

{{-- Banner --}}
<section class="hero-section position-relative bg-light-blue padding-medium">
    <div class="hero-content">
      <div class="container">
        <div class="row">
          <div class="text-center padding-large no-padding-bottom">
            <h1 class="display-2 text-uppercase text-dark">Blog</h1>
            <div class="breadcrumbs">
              <span class="item">
                <a href="{{ route('index') }}">Home ></a>
              </span>
              <span class="item">Blog</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="post-grid padding-large">
    <div class="container">
        <div class="row d-flex flex-wrap">
            <aside class="col-md-3">
                <div class="sidebar">
                    <div class="sidebar-filter pt-5">                    
                        {{-- <div class="widget sidebar-recent-post mb-5">
                            <h5 class="widget-title text-uppercase">Latest Posts</h5>
                            <div class="sidebar-post-item">
                                <div class="d-flex flex-wrap align-items-center mb-3">
                                    <div class="col-lg-6">
                                        <div class="card-image pe-3 pb-2">
                                            <a href="#">
                                                <img src="{{ asset('frontend/images/post-small-image1.jpg') }}" alt="blog" class="img-fluid">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card-content">
                                            <h4 class="card-title">
                                                <a href="#">TOP 10 SMALL CAMERA IN THE WORLD</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-post-item">
                                <div class="d-flex flex-wrap align-items-center mb-3">
                                    <div class="col-lg-6">
                                        <div class="card-image pe-3 pb-2">
                                            <a href="#">
                                                <img src="{{ asset('frontend/images/post-small-image2.jpg') }}" alt="blog" class="img-fluid">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card-content">
                                            <h4 class="card-title">
                                                <a href="#">TECHNOLOGY HACK YOU WON’T GET</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-post-item">
                                <div class="d-flex flex-wrap align-items-center mb-3">
                                    <div class="col-lg-6">
                                        <div class="card-image pe-3 pb-2">
                                            <a href="#">
                                                <img src="{{ asset('frontend/images/post-small-image3.jpg') }}" alt="blog" class="img-fluid">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card-content">
                                            <h4 class="card-title">
                                                <a href="#">GET SOME COOL GADGETS IN 2023</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="widget sidebar-social-links mb-5">
                            <h5 class="widget-title text-uppercase">Social Links</h5>
                            <ul class="sidebar-list list-unstyled">
                                <li class="tags-item">
                                    <a href="">Facebook</a>
                                </li>
                                <li class="tags-item">
                                    <a href="">Instagram</a>
                                </li>
                                <li class="tags-item">
                                    <a href="">Twitter</a>
                                </li>
                                <li class="tags-item">
                                    <a href="">Pinterest</a>
                                </li>
                                <li class="tags-item">
                                    <a href="">Youtube</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </aside>
            <main class="col-md-9">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card border-none">
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
                                <a href="#">Máy chơi Game "Quốc Dân" của năm 2023 sắp ra mắt</a>
                            </h3>
                        </div>
                    </div>
                   
                   
                    <div class="col-lg-4">
                        <div class="card border-none">
                            <div class="card-image">
                                <img src="{{ asset('frontend/images/post-item4.jpg') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="card-body text-uppercase">
                            <div class="card-meta text-muted">
                                <span class="meta-date">feb 27, 2023</span>
                                <span class="meta-category">- technology</span>
                            </div>
                            <h3 class="card-title">
                                <a href="#">Get some cool gadgets in 2023</a>
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border-none">
                            <div class="card-image">
                                <img src="{{ asset('frontend/images/post-item5.jpg') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="card-body text-uppercase">
                            <div class="card-meta text-muted">
                                <span class="meta-date">March 09, 2023</span>
                                <span class="meta-category">- technology</span>
                            </div>
                            <h3 class="card-title">
                                <a href="{{ route('posts') }}">APPLE CHO RA MẮT KÍNH THỰC TẾ ẢO VISION PRO</a>
                            </h3>
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
        </div>
    </div>
</section>

{{-- thiếu dòng @endsection cho section maincontent sẽ bị mất head --}}
@endsection 


