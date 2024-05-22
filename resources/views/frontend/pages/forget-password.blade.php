@extends('frontend.layouts.layoutblank')
@section('title', env('APP_NAME') . ' || Forget Password Page')
@section('main-content')
<section class="section">
    <div class="container">
        <div class="row full-height justify-content-center">
            <div class="col-12 text-center align-self-center py-5">
                <main>
                    <div class="section-foreget-password container text-center">
                        <div class="heading-forget">
                            <h4 class="pb-3">Forget Password</h4>
                            <span>Please enter your email, we will help you to recover your account.</span>
                        </div>
                        <form class="form form-forget-pw" method="POST" action="{{ route('forget.password.post') }}">
                            @csrf
                            <div class="form-group input-forget-pw">
                                    <input type="text" name="email" class="form-style input-email-recover" placeholder="Email">
                                    <i class="input-icon uil uil-user"></i>
                            </div>
                            <button type="submit" class="btn mt-4">Submit</button>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </div>
</section>
@endsection
@push('after_scripts')
    {{-- <script src="{{asset('frontend/js/jquery-1.11.0.min.js')}}"></script> --}}
@endpush