@extends('frontend.layouts.master')
@section('title', env('APP_NAME') . ' || INDEX')
@section('main-content')
@include('frontend.layouts.header_fe')

  @php
    $svgContent = file_get_contents(public_path('frontend/svg/index.svg'));
    echo $svgContent;

  @endphp

@include('frontend.sections.banner')
@include('frontend.sections.company-services')


<section id="" class="product-store position-relative padding-large no-padding-top">
    <div class="container">
        <div class="row">
            <div class="display-header d-flex justify-content-between pb-3">
                <h2 class="display-7 text-dark text-uppercase"> Products</h2>
                <div class="btn-right">
                    <a href="" class="btn btn-medium btn-normal text-uppercase">Go to Shop</a>
                </div>
            </div>
            <div class="swiper product-swiper">
                <div class="swiper-wrapper" >
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img src="{{ asset('frontend/images/ip14black.png') }}" alt="product-item" class="img-fluid">
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 14 ProMax 128gb</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">28.000.000-29.000.000₫</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img  src="{{ asset('frontend/images/ip14gold.png') }}" alt="product-item" class="img-fluid">
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 14 Promax 256gb</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">28.000.000-29.500.000₫</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img  src="{{ asset('frontend/images/ip14sliver.png') }}"  alt="product-item" class="img-fluid">
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 14 Pro 128gb</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">26.000.000-27.000.000₫</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img src="{{ asset('frontend/images/ip14purple.png') }}"  alt="product-item" class="img-fluid">
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 14 Pro 256gb</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">27.900.000-29.000.000₫</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img src="{{ asset('frontend/images/item_1.png') }}"  alt="product-item" class="img-fluid">
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 14 ProMax 128gb</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">28.000.000 ₫</h5>
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
                <a href="shop" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop Sale</a>
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
                    <a href="{{route('blog')}}" class="btn btn-medium btn-normal text-uppercase">Read Blog</a>
                </div>
            </div>
            {{-- <div class="post-grid d-flex flex-wrap justify-content-between">
                @foreach ($posts as $post)
                    <div class="col-lg-4 col-sm-12">
                        <div class="card border-none me-3">
                            <div class="card-image">
                                <img src="{{$post->photo }}" alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="card-body text-uppercase">
                            <div class="card-meta text-muted">
                                <span class="meta-date">{{$post->created_at->format('d/m/YY') }}</span>
                            </div>
                            <h3 class="card-title">
                                <a href="{{route('blog.detail',$post->slug)}}">{{$post->title }}</a>
                            </h3>
                        </div>
                    </div>
               @endforeach
                
            </div> --}}
        </div>
    </div>
</section>
@include('frontend.layouts.subscribe')
@include('frontend.sections.testimonial')
<script>
    function scrollToCategory(slug, event) {
        event.preventDefault();
        var target = document.getElementById(slug);

        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    }
</script>

@endsection 


