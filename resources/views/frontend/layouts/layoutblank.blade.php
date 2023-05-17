<!DOCTYPE html>
<html lang="zxx">
<head>
    @include('frontend.layouts.head')
</head>
<body class="js">
<div class="container_blank_page">
    <!-- Preloader -->
{{--    <div class="preloader">--}}
{{--        <div class="preloader-inner">--}}
{{--            <div class="preloader-icon">--}}
{{--                <span></span>--}}
{{--                <span></span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- End Preloader -->
    @include('frontend.layouts.notification')
    @yield('main-content')
    {{-- @include('frontend.layouts.footer') --}}

    @yield('after_scripts')
    @stack('after_scripts')
</div>
</body>
</html>
