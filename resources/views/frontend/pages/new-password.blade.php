@extends('frontend.layouts.layoutblank')
@section('title', env('APP_NAME') . ' || New Password Page')
@section('main-content')
<section class="section">
    <div class="container">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissable fade show text-center">
                <button class="close" data-dismiss="alert" aria-label="Close">×</button>
                {{session('error')}}
            </div>
        @endif 

        @if(session('success'))
            <div id="success-alert" class="alert alert-success alert-dismissable fade show text-center">
                {{-- <button class="close" data-dismiss="alert" aria-label="Close">×</button> --}}
                {{session('success')}}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger text-center">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row full-height justify-content-center">
            <div class="col-12 text-center align-self-center py-5">
                <main>
                    <div class="section-foreget-password container text-center">
                        <div class="heading-forget">
                            <h4 class="pb-3">Forget Password</h4>
                            <span>Please enter your email, we will help you to recover your account.</span>
                        </div>
                        <form class="form form-forget-pw" method="POST" action="{{ route('reset.password.post') }}">
                            <input type="hidden" name="token" value="{{$token}}">
                            @csrf
                            <div class="form-group input-forget-pw">
                                    <input type="text" name="email" class="form-style input-email-recover" placeholder="Email">
                                    <i class="input-icon uil uil-user"></i>
                            </div>
                            <div class="form-group input-forget-pw mt-2">
                                <input type="password" name="password" class="form-style input-email-recover" placeholder="Password">
                                <i class="input-icon uil uil-lock-alt"></i>
                            </div>
                            <div class="form-group input-forget-pw mt-2">
                                <input type="password" name="password_confirmation" class="form-style input-email-recover" placeholder="Confirm Password">
                                <i class="input-icon uil uil-lock-alt"></i>
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