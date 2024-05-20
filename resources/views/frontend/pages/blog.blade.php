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
                <a href="{{ route('home') }}">Home ></a>
              </span>
              <span class="item">Blog</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<section class="post-grid padding-large">
    <div class="container tw-flex tw-flex-col tw-gap-10">
        <div class="tw-flex tw-flex-row tw-gap-5">
            @foreach($posts->chunk(4) as $chunk)
                <div class="tw-w-1/2">
                    @if($chunk->count() > 0)
                        <div class="card border-none tw-relative tw-flex-grow">
                            <div class="card-image">
                                <img src="{{ $chunk[0]->photo }}" alt="" class="img-fluid tw-min-w-full">
                            </div>
                            <div class="card-body text-uppercase tw-absolute tw-bottom-0 tw-text-white">
                                <div class="card-meta">
                                    <span class="meta-date">{{ $chunk[0]->created_at->format('d/m/Y') }}</span>
                                    <span class="meta-category">- Gadgets</span>
                                </div>
                                <h3 class="card-title tw-capitalize">
                                    <a class="hover:tw-text-third" href="{{ route('blog.detail', $chunk[0]->slug) }}">{{ $chunk[0]->title }}</a>
                                </h3>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="tw-w-1/2">
                    <div class="row">
                        @foreach($chunk->slice(1) as $post)
                            <div class="col-lg-12 mb-4">
                                <div class="card tw-flex tw-flex-row tw-items-center tw-border-0">
                                    <div class="card-image tw-w-[200px] tw-h-full tw-shrink-0">
                                        <img src="{{ $post->photo }}" alt="" class="img-fluid tw-w-full tw-rounded-md tw-object-cover">
                                    </div>
                                    <div class="card-body text-uppercase">
                                        <div class="card-meta text-muted">
                                            <span class="meta-date">{{ $post->created_at->format('d/m/Y') }}</span>
                                            <span class="meta-category">- Gadgets</span>
                                        </div>
                                        <h3 class="card-title tw-capitalize">
                                            <a class="tw-text-base hover:tw-text-third" href="{{ route('blog.detail', $post->slug) }}">{{ $post->title }}</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    
        @if($posts->count())
            <div class="pagination">
                {!! $posts->links('pagination::bootstrap-4') !!}
            </div>
        @endif
    </div>
</section>

@endsection 


