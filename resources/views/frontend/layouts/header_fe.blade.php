{{-- trang header_fe chỉ dùng cho index_fe --}}
@include('frontend.popup.search')
@if ($errors->any())
    <div class="alert alert-danger alert-dismissable fade show text-center">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>  
@elseif(session('success'))
    <div class="alert alert-success alert-dismissable fade show text-center">
        {{session('success')}}
    </div>
@endif
<header id="header" class="site-header header-scrolled position-fixed text-black bg-light header">
    <nav id="header-nav" class="navbar navbar-expand-lg px-3 mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="index">
                <img src="{{ asset('frontend/images/main-logo.png') }}" class="logo">
            </a>
            <button class="navbar-toggler d-flex d-lg-none order-3 p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <svg class="navbar-icon">
          <use xlink:href="#navbar-icon"></use>
        </svg>
      </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel">
                <div class="offcanvas-header px-4 pb-0">
                    <a class="navbar-brand" href="index">
                        <img  src="{{ asset('frontend/images/main-logo.png') }}" class="logo">
                    </a>
                    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close" data-bs-target="#bdNavbar"></button>
                </div>
                <div class="offcanvas-body">
                    <ul id="navbar" class="navbar-nav text-uppercase justify-content-end align-items-center flex-grow-1 pe-3" style="margin-right: 40px;">
                        <li class="nav-item">
                            <a class="nav-link me-4 active" href="#billboard">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link me-4" href="#mobile-products">iPhone</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#ipad-products">iPad</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#smart-watches">Watch</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#desktop-mac">Macbook</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#yearly-sale">Khuyến mại</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#latest-blog">Tin Tức</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link me-4" href="#latest-news">Tin tức</a>
                        </li> -->

                        <li class="nav-item dropdown">
                            <a class="nav-link me-4 dropdown-toggle link-dark" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Pages</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="about.html" class="dropdown-item">About Us</a>
                                </li>
                                <li>
                                    <a href="blog.html" class="dropdown-item">Blog</a>
                                </li>
                                <li>
                                    <a href="shop" class="dropdown-item">Shop</a>
                                </li>
                                <li>
                                    <a href="cart" class="dropdown-item">Cart</a>
                                </li>
                                <li>
                                    <a href="checkout.html" class="dropdown-item">Checkout</a>
                                </li>
                                <li>
                                    <a href="single-post.html" class="dropdown-item">Single Post</a>
                                </li>
                                <li>
                                    <a href="single-product.html" class="dropdown-item">Single Product</a>
                                </li>
                                <li>
                                    <a href="contact.html" class="dropdown-item">Contact</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            @if(Auth::check())
                            <div class="user-items ps-5">
                                <ul class="d-flex justify-content-end list-unstyled">
                                   
                                    {{-- khi user chưa đăng nhập --}}
                                    {{-- <li class="pe-3 nav-item dropdown">
                                        <a class="" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg class="user">
                        <use xlink:href="#user"></use>
                                            </svg>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="#"><span class="small-text">Đăng nhập</span></a></li>
                                            <li><a class="dropdown-item" href="#"><span class="small-text">Tạo tài khoản ngay</span></a></li>
                                        </ul>
                                    </li> --}}
                                     
                                    {{-- khi user đã đăng nhập rồi --}}
                                    <li class="pe-3 nav-item dropdown">
                                        <a  href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                          <svg class="user">
                                            <use xlink:href="#user"></use>
                                          </svg>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                          <li><a class="dropdown-item" href="#"><span class="small-text" style="font-weight: 600">Nguyễn Anh Dũng</span></a></li>
                                          <li><a class="dropdown-item" href="{{route('user.logout')}}" id="log-out"><span class="small-text">Đăng xuất</span></a></li>
                                        </ul>
                                      </li>
                                      

                                    <li class="pe-3">
                                        <a href="cart">
                                            <svg class="cart">
                        <use xlink:href="#cart"></use>
                      </svg>
                                        </a>
                                    </li>

                                    <li class="search-item pe-3">
                                        <a href="#" class="search-button">
                                            <svg class="search">
                        <use xlink:href="#search"></use>
                      </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                    
                        @else
                                <li class="box_login"><a class="login" href="{{route('login.form')}}">{{ __('Login') }}</a></li>
                            @endif                      
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>