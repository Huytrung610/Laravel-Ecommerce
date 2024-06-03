@extends('frontend.layouts.layoutblank')
@section('title', env('APP_NAME') . ' || Login Page')
@section('main-content')



<section class="section-login">
    <div class="container-login-page">
        <div class="user signinBx">
            <div class="imgBx"><img src="{{asset('frontend/img/modern-stationary-collection.png')}}" alt="" /></div>
            <div class="formBx">
            <form method="post" action="{{route('login.submit')}}">
                @csrf
                <h2>Sign In</h2>
                <input type="text" name="email" placeholder="Email" required="required" />
                <input type="password" name="password" placeholder="Password" required="required"/>
                <input type="submit" name="" value="Login" />
                <p class="forgot-pw-button"><a href="{{ route('forget.password') }}">Forgot your password?</a></p>
                <p class="signup">
                Don't have an account ?
                <a href="#" class="sign-in--btn">Sign Up.</a>
                </p>
            </form>
            </div>
        </div>
        <div class="user signupBx">
            <div class="formBx">
            <form method="post" class="register-form" action="{{ route('register.submit') }}">
                @csrf
                <h2>Create an account</h2>
                <div class="input-register--wrapper">
                    <input type="text" name="name" placeholder="Username" />
                    <input type="email" name="email" placeholder="Email Address" />
                    <input type="password" name="password" class="passowrd-register" placeholder="Create Password" />
                    <input type="password" name="confirm_password" class="confirm_password-register" placeholder="Confirm Password" />
                    <span class="password-error">Passwords do not match!</span>
                </div>
               
                <button type="submit" class="signup-submit" disabled name="" value="Sign Up">Sign Up</button>
                <p class="signup">
                Already have an account ?
                <a href="#" class="sign-in--btn">Sign in.</a>
                </p>
            </form>
            </div>
            <div class="imgBx"><img src="{{asset('frontend/img/modern-stationary-collection.png')}}" alt="" /></div>
        </div>
    </div>
</section>

@endsection
@push('after_scripts')
    <script src="{{ mix('js/frontend/login.js') }}"></script>

    <script>
    $(document).ready(function() {
        $('.sign-in--btn').on('click', function (event) {
            event.preventDefault();
            $('.container-login-page').toggleClass('active');
        });
    });
    </script>
@endpush