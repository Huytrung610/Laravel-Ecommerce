<section id="hero-banner">
    <div class="swiper-banner-container">
        <div class="swiper-wrapper">
            @foreach($banners as $banner)
                <a @if($banner->url) href="{{$banner->url}}" @endif class="swiper-slide banner-item tw-relative">
                    <div class="banner-img-wrapper">
                        <img src="{{$banner->photo}}" alt="{{$banner->photo}}" class="banner-img">
                    </div>
                    <div class="banner-content-wrapper tw-absolute tw-bottom-[20%] tw-left-[12%]">
                        <h1 class="heading-banner tw-font-semibold tw-text-xl">{!! html_entity_decode($banner->heading) !!}</h1>
                        <span class="des-banner tw-text-sm">{!! html_entity_decode($banner->description) !!}</span>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>
<style>
    #hero-banner .swiper-button-prev, #hero-banner .swiper-button-next {
        top: 38%;
    }
    #hero-banner .swiper-button-prev:after, .swiper-button-next:after {
        color: #FFF;
        font-weight: 600;
    }
    #hero-banner .swiper-banner-container {
       overflow: hidden;
    }
    .swiper-slide img.banner-img {
        width: 100%;
        height: auto;
    }
</style>
<script src="{{ mix('js/frontend/banner.js') }}"></script>