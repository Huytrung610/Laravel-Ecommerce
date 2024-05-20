@extends('frontend.layouts.master')

@section('title', env('APP_NAME') . ' || Posts')

@section('main-content')

@include('frontend.layouts.header_fe')


@php
    $svgContent = file_get_contents(public_path('frontend/svg/posts.svg'));
    echo $svgContent;
  @endphp

<div class="post-wrap">
    <div class="container">
        <div class="post-item mt-5 tw-flex tw-flex-col tw-justify-center tw-items-center">
            <div class="post-thumbnail tw-w-[990px] tw-h-[413px] tw-flex tw-justify-center tw-overflow-hidden">
                <img class="tw-rounded-3xl tw-w-full tw-h-full tw-object-cover" src="{{$post->photo}}" alt="">
            </div>            
            <div class="post-content tw-max-w-[950px]">
                <div class="post-meta text-uppercase">
                    <span class="post-category">{{$post->created_at->format('d/m/Y')}} </span> / <span class="meta-date">-  technology</span>
                </div>
                <h1 class="post-title tw-text-xl tw-font-bold">{{$post->title}}</h1>
                <div class="post-description review-item tw-pt-10">
                    <p>
                        {!! ($post->description) !!}
                    </p>

                    <div class="post-bottom-link tw-flex justify-content-between">
                       
                        <div class="social-links d-flex">
                            <div class="element-title pe-2 tw-font-bold">Share:</div>
                            <ul class="tw-flex tw-gap-3">
                                <li class="!tw-pr-0">
                                    <a href="#">
                                        <svg class="facebook">
                                            <use xlink:href="#facebook"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li class="!tw-pr-0">
                                    <a href="#">
                                        <svg class="instagram">
                                            <use xlink:href="#instagram"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li class="!tw-pr-0">
                                    <a href="#">
                                        <svg class="twitter">
                                            <use xlink:href="#twitter"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li class="!tw-pr-0">
                                    <a href="#">
                                        <svg class="linkedin">
                                            <use xlink:href="#linkedin"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li class="!tw-pr-0">
                                    <a href="#">
                                        <svg class="youtube">
                                            <use xlink:href="#youtube"></use>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('frontend.sections.company-services')

@endsection 


