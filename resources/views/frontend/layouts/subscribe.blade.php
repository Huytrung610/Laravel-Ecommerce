
@if (session('subscribe_status'))
    @if (session('subscribe_status') == 'success')
        <div class="alert alert-success">
            {{ session('message', 'Thanks for Subscribing') }}
        </div>
    @elseif (session('subscribe_status') == 'error')
        <div class="alert alert-danger">
            {{ session('message', 'Failed to Subscribe') }}
        </div>
    @endif
    @php
        // Xóa thông báo sau khi hiển thị
        session()->forget('subscribe_status');
    @endphp
@endif

<section id="subscribe" class="container-grid position-relative overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="subscribe-content bg-dark d-flex flex-wrap justify-content-center align-items-center padding-medium">
                <div class="col-md-6 col-sm-12">
                    <div class="display-header pe-3">
                        <h1 class="display-7 text-uppercase tw-text-white tw-font-bold tw-text-[24px]">Subscribe Us Now</h1>
                        <p>Đăng ký địa chỉ email với chúng tôi để nhận được những thông tin mới nhất về những sản phẩm đang và sắp được ra mắt.</p>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12">
                    <form class="subscription-form validate" method="POST">
                        @csrf
                        <div class="input-group flex-wrap">
                            <input class="form-control btn-rounded-none" id="email_subcriber" type="email" name="EMAIL" placeholder="Your email address here" required="">
                            <button class="btn btn-medium btn-primary text-uppercase btn-rounded-none btn-add-subcriber" 
                                    type="submit"
                                    name="subscribe">Subscribe
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@push('after_scripts')
    <script src="{{ mix('js/frontend/newsletter.js') }}"></script>
@endpush