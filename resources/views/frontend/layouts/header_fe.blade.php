
@php
    $user = auth()->user() ?? null;
    if(Auth::check()){
        $listAddress = $user->getAddress();
        $defaultAddress =$user->getAddressDefault() ?? $listAddress->First();
    }

@endphp
<header id="header" class="header-scrolled tw-bg-secondary tw-sticky tw-top-0 tw-left-0 text-black header tw-z-10">
    {{-- @include('frontend.popup.search')  --}}
    <nav id="header-nav" class="navbar navbar-expand-lg px-3">
        <div class="container-fluid">
            <a class="navbar-brand tw-w-36" href="{{ route('home') }}">
                @if(isset($settings['logo_path']) && $settings['logo_path'])
                <img src="{{ $settings['logo_path'] }}" class="logo">
                @endif
            </a>
            <button class="navbar-toggler d-flex d-lg-none order-3 p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <svg class="navbar-icon">
          <use xlink:href="#navbar-icon"></use>
        </svg>
      </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel">
                <div class="offcanvas-header px-4 pb-0">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('frontend/images/main-logo.png') }}" class="logo">
                    </a>
                    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close" data-bs-target="#bdNavbar"></button>
                </div>
                <div class="offcanvas-body">
                    <ul id="navbar" class="navbar-nav text-uppercase justify-content-end align-items-center flex-grow-1 pe-3" style="margin-right: 40px;">
                        <li class="nav-item">
                            <a class="nav-link me-4 @if(request()->routeIs('home')) active @endif" href="{{ route('home') }}">Home</a>
                        </li>
                        @php
                            $parentCategories = \App\Models\Category::getParentCategories();
                        @endphp
                        @foreach ($parentCategories as $category)
                            <li class="nav-item nav-item-menu">
                                <a class="nav-link me-4 !tw-text-third" href="{{ route('product-list', ['slug' => $category->slug]) }}" >{{ $category->title }}
                                    {{-- <i class="fa fa-caret-down dropdown-nav-icon"></i> --}}
                                </a>
                                @php
                                        $childCategories = \App\Models\Category::getChildCatByParentCat( $category->id);
                                @endphp
                                @if($childCategories->count() > 0)
                                    <ul class="item_small-header tw-w-fit tw-min-w-36 tw-top-[30px] tw-left-[8px] tw-rounded tw-border tw-border-white tw-bg-white tw-py-2 tw-whitespace-nowrap">
                                        @foreach ($childCategories as $childCategory)
                                            <li class="tw-p-1 tw-pl-0.5 tw-pb-2.5 tw-px-2 tw-border-b hover:tw-bg-third">
                                                <a href="{{ route('product-list', ['slug' => $childCategory->slug]) }}" class="tw-text-sm tw-capitalize hover:tw-text-black" title="{{$childCategory->title}}">{{$childCategory->title}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                        <li class="nav-item dropdown">
                            <a class="nav-link me-4 dropdown-toggle !tw-text-third" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Pages</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('about-us') }}" class="dropdown-item">About Us</a>
                                </li>
                                 <li>
                                    {{-- <a href="blog" class="dropdown-item">Blog</a> --}}
                                    <a href="{{route('blog')}}" class="dropdown-item">Blog</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            @if(Auth::check())
                            <div class="user-items ">
                                <ul class="d-flex justify-content-end list-unstyled">
                                    <li class="pe-3 nav-item dropdown tw-flex tw-items-center">
                                        <a  href="{{route('profile')}}" class="tw-text-third" >
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-w-6 tw-h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="tw-flex tw-items-center tw-text-third" href="{{route('checkout')}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-w-6 tw-h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                              </svg>                                              
                                            <span class="total-count tw-text-third tw-bg-black tw-rounded-full tw-px-[5px] tw-py-[2px] tw-text-[11px] tw-relative tw-top-[-8px] tw-right-[8px]">{{Helper::cartCount()}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item dropdown no-arrow mx-1">
                                        @include('frontend.pages.user.notification.show-notification')
                                    </li>
                                </ul>
                            </div>
                    
                        @else
                                <li class="box_login tw-text-third"><a class="login" href="{{route('login.form')}}">{{ __('Login') }}</a></li>
                            @endif                      
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <style>
        li.pe-3 a {
            position: relative;
            display: inline-block;
        }
    </style>
</header>
