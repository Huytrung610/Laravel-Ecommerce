<footer id="footer" class="overflow-hidden tw-mt-10">
    <div class="container">
        <div class="row">
            <div class="footer-top-area">
                <div class="row d-flex flex-wrap justify-content-between">
                    <div class="col-lg-3 col-sm-6 pb-3">
                        <div class="footer-menu tw-flex tw-flex-col tw-gap-4">
                            @if(isset($settings['logo_path']) && $settings['logo_path'])
                                <img class="tw-w-24" src="{{ $settings['logo_path'] }}" alt="logo">
                            @endif
                            <p class="tw-text-base">DT store là đại lý uỷ quyền của Apple tại Việt Nam.Chúng tôi phát triển chuỗi cửa hàng tiêu chuẩn 
                                và Apple Mono Store nhằm mang đến trải nghiệm tốt nhất về sản phẩm và dịch vụ của 
                                Apple cho người dùng Việt Nam.</p>
                            <div class="social-links">
                                <ul class="d-flex list-unstyled">
                                    @if(isset($settings['url_facebook']) && $settings['url_facebook'])
                                        <li>
                                            <a href="{{ $settings['url_facebook'] }}" target="_blank">
                                                <svg class="facebook">
                                                    <use xlink:href="#facebook" />
                                                </svg>
                                            </a>
                                        </li>
                                        @endif
                                        @if(isset($settings['url_instagram']) && $settings['url_instagram'])
                                        <li>
                                            <a href="{{ $settings['url_instagram'] }}" target="_blank">
                                                <svg class="instagram">
                                                    <use xlink:href="#instagram" />
                                                </svg>
                                            </a>
                                        </li>
                                        @endif
                                        <li>
                                            <a href="#">
                                                <svg class="twitter">
                                                <use xlink:href="#twitter" />
                                            </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <svg class="linkedin">
                                                    <use xlink:href="#linkedin" />
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <svg class="youtube">
                                                <use xlink:href="#youtube" />
                                            </svg>
                                            </a>
                                        </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 pb-3 tw-pt-2.5">
                        <div class="footer-menu text-uppercase">
                            <h5 class="widget-title pb-2 tw-font-bold">Policys</h5>
                            <ul class="menu-list list-unstyled text-uppercase tw-mt-2.5">
                                <li class="menu-item pb-2">
                                    <a href="{{ route('payment-policy') }}">Payment policy</a>
                                </li>
                                <li class="menu-item pb-2">
                                    <a href="{{ route('shipping-policy') }}">Shipping policy</a>
                                </li>
                                <li class="menu-item pb-2">
                                    <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
                                </li>
                                <li class="menu-item pb-2">
                                    <a href="{{ route('warranty-policy') }}">Warranty Policy</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 pb-3 tw-pt-2.5">
                        <div class="footer-menu text-uppercase">
                            <h5 class="widget-title pb-2 tw-font-bold">Help & Info Help</h5>
                            <ul class="menu-list list-unstyled tw-mt-2.5">
                                <li class="menu-item pb-2">
                                    <a href="#">Track Your Order</a>
                                </li>
                                <li class="menu-item pb-2">
                                    <a href="#">Returns Policies</a>
                                </li>
                                <li class="menu-item pb-2">
                                    <a href="#">Shipping + Delivery</a>
                                </li>
                                <li class="menu-item pb-2">
                                    <a href="#">Contact Us</a>
                                </li>
                                <li class="menu-item pb-2">
                                    <a href="#">Faqs</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 pb-3 tw-pt-2.5">
                        <div class="footer-menu contact-item tw-flex tw-flex-col tw-gap-4">
                            <h5 class="widget-title text-uppercase pb-2 tw-font-bold">Contact Us</h5>
                            @if(isset($settings['email']) && $settings['email'])
                                <a class="tw-text-primary" href="mailto:{{ $settings['email'] }}">Bạn có những câu hỏi thắc mắc, đừng ngần ngại gửi email cho chúng tôi tại địa chị gmail:
                                     <strong href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</strong>
                                </a>
                            @endif
                            @if(isset($settings['contact_phone']) && $settings['contact_phone'])
                                <a class="tw-text-primary" href="tel:{{ $settings['contact_phone'] }}">Số điện thoại tổng đài 24/7 hãy liên hệ <strong  href="tel:{{ $settings['contact_phone'] }}">{{ $settings['contact_phone'] }}</strong>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
</footer>
<div id="footer-bottom" class="tw-py-2.5 tw-bg-[#41454F]">
    <div class="container">
        <div class="row d-flex flex-wrap justify-content-between">
            <div class="col-md-4 col-sm-6">
                <div class="Shipping d-flex">
                    <p>We ship with:</p>
                    <div class="card-wrap ps-2 tw-flex tw-gap-2.5 tw-items-center">
                        <img src="{{ asset('frontend/images/ghtk-footer.png') }}" class="tw-w-[51px] tw-h-5"  alt="dhl">
                        <img src="{{ asset('frontend/images/grab.svg') }}" class="tw-w-[51px] tw-h-[31px]" alt="grab">
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 tw-flex tw-justify-end">
                <div class="payment-method d-flex">
                    <p>Payment options:</p>
                    <div class="card-wrap ps-2 tw-flex tw-gap-2.5">
                        <img src="{{ asset('frontend/images/visa.svg') }}"  alt="visa">
                        <img src="{{ asset('frontend/images/mastercard.svg') }}" alt="mastercard">
                        <img src="{{ asset('frontend/images/cash.svg') }}" alt="cash">
                        <img src="{{ asset('frontend/images/banking.svg') }}" alt="paypal">
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
{{-- <script src="js/jquery-1.11.0.min.js"></script> --}}
<script src="{{ asset('frontend/js/jquery-1.11.0.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

{{-- <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script> --}}
<script type="text/javascript" src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script> 

{{-- <script type="text/javascript" src="js/plugins.js"></script> --}}
<script type="text/javascript" src="{{ asset('frontend/js/plugins.js') }}"></script>

{{-- <script type="text/javascript" src="js/script.js"></script> --}}
<script type="text/javascript" src="{{ asset('frontend/js/script.js') }}"></script>

