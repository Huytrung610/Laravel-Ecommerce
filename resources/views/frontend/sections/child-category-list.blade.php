<section id="child-category--list" class="product-store position-relative padding-large no-padding-top">
    <div class="container">
        <div class="row">
            <div class="child-category--grid-container">
                <div class="child-category--grid-wrapper tw-grid tw-grid-cols-4 tw-gap-x-4 tw-gap-y-6">
                    @foreach($categoryGrid as $categoryItem)
                        <div class="child-category--grid-item tw-bg-white tw-rounded-xl tw-px-2.5 tw-pt-4 tw-pb-3 tw-shadow-2xl">
                            <a class="child-category--item_grid tw-flex tw-flex-col tw-gap-5" href="{{ route('product-list', ['slug' => $categoryItem->slug]) }}">
                                <div class="card-category--title tw-flex tw-justify-center">
                                    <h3 class="card-title tw-text-center">{{ $categoryItem->title }}</h3>
                                </div>
                                <div class="card-category--img tw-overflow-hidden">
                                    <img src="{{ $categoryItem->photo ?? asset('backend/img/default-product-image.png') }}" alt="{{ $categoryItem->photo ?? asset('backend/img/default-product-image.png') }}" class="img-fluid">
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-pagination position-absolute text-center"></div>
</section>