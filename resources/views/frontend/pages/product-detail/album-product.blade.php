
@if($productDetail->has_variants == 1)
    <div class="product_detail--gallery">                
        <div class="swiper-container product_detail--gallery-slider">
            <div class="swiper-wrapper">
                
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>

        <div class="swiper-container product_detail--gallery-thumbs">
            <div class="swiper-wrapper">
            </div>
        </div>
    </div>
@else 
    <div class="product_detail--gallery">                
        <div class="swiper-container product_detail--gallery-slider">
            <div class="swiper-wrapper">
                @if($productDetail->album)
                    @foreach(explode(',', $productDetail->album) as $image)
                        <div class="swiper-slide"><img src="{{$image}}" alt="{{$image}}"></div>
                    @endforeach
                @else
                <div class="swiper-slide"><img src="{{asset('images/placeholder.png')}}" alt="{{asset('images/placeholder.png')}}"></div>
                @endif
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>

        <div class="swiper-container product_detail--gallery-thumbs">
            <div class="swiper-wrapper">
                @if($productDetail->album)
                @foreach(explode(',', $productDetail->album) as $image)
                    <div class="swiper-slide"><img src="{{$image}}" alt="{{$image}}"></div>
                @endforeach
                @else
                <div class="swiper-slide"><img src="{{asset('images/placeholder.png')}}" alt="{{asset('images/placeholder.png')}}"></div>
                @endif
            </div>
        </div>
    </div>
@endif
<script>
    var defaultImg = "{{ asset('images/placeholder.png') }}";
</script>