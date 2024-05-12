@extends('frontend.layouts.master')

@section('title', env('APP_NAME') . ' || About Us')

@section('main-content')

@include('frontend.layouts.header_fe')


@php
    $svgContent = file_get_contents(public_path('frontend/svg/aboutus.svg'));
    echo $svgContent;
  @endphp

{{-- Banner --}}
<section class="hero-section position-relative bg-light-blue padding-medium">
    <div class="hero-content">
        <div class="container">
            <div class="row">
                <div class="no-padding-bottom">
                    <h1 class="tw-text-4xl tw-font-bold text-uppercase text-dark text-center">{{$cmsContent->title}}</h1>
                    <div class="breadcrumbs">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="cms-content" class="tw-mt-11">
    <div class="container">
        {!! htmlspecialchars_decode($cmsContent->content) !!}
    </div>
</section>

<section id="our-store" class="tw-mt-11">
    <div class="container">
        <div class="row d-flex flex-wrap align-items-center">
            <div class="col-lg-6">
                <div class="image-holder mb-5">
                    <img src="{{ asset('frontend/images/single-image2.jpg') }}" alt="our-store" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="locations-wrap">
                    <div class="display-header">
                        <h2 class="display-7 text-uppercase text-dark">Contact Us</h2>
                        <p>Bạn có thể liên lạc với chúng tôi</p>
                    </div>
                    <div class="location-content d-flex flex-wrap">
                        <div class="col-lg-6 col-sm-12">
                            <div class="content-box text-dark pe-4 mb-5">
                                <h3 class="card-title text-uppercase text-decoration-underline">Office</h3>
                                <div class="contact-address pt-3">
                                    <p>55 Giải Phóng, Quận Hai Bà Trưng, Thành phố Hà Nội, Việt Nam </p>
                                </div>
                                <div class="contact-number">
                                    <p>
                                        <a href="#">+123 987 789</a>
                                    </p>
                                    <p>
                                        <a href="#">+123 123 321</a>
                                    </p>
                                </div>
                                <div class="email-address">
                                    <p>
                                        <a href="#">ministore@yourinfo.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="content-box">
                                <h3 class="card-title text-uppercase text-decoration-underline">Việt Nam </h3>
                                <div class="contact-address pt-3">
                                    <p>55 Giải Phóng, Quận Hai Bà Trưng, Thành phố Hà Nội, Việt Nam</p>
                                </div>
                                <div class="contact-number">
                                    <p>
                                        <a href="#">+123 987 789</a>
                                    </p>
                                    <p>
                                        <a href="#">+123 123 321</a>
                                    </p>
                                </div>
                                <div class="email-address">
                                    <p>
                                        <a href="#">ministore@yourinfo.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend.sections.company-services')

@endsection 


