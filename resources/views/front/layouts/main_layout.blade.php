<!DOCTYPE html>
<html lang="zxx">

<head>
    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="eCommerce,shop,fashion">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--====== Title ======-->
    <title> Chine Boutique </title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{asset('frontend/'.App::getLocale().'/assets/images/logo.png')}}" type="image/png">
    <!--====== Google Fonts ======-->
    <link
        href="https://fonts.googleapis.com/css2?family=Aoboshi+One&amp;family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&amp;display=swap"
        rel="stylesheet">
    <!--====== Flaticon css ======-->
    <link rel="stylesheet" href="{{asset('frontend/'.App::getLocale().'/assets/fonts/flaticon/flaticon_pesco.css')}}">
    <!--====== FontAwesome css ======-->
    <link rel="stylesheet" href="{{asset('frontend/'.App::getLocale().'/assets/fonts/fontawesome/css/all.min.css')}}">
    <!--====== Bootstrap css ======-->
    <link rel="stylesheet"
        href="{{asset('frontend/'.App::getLocale().'/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--====== Slick-popup css ======-->
    <link rel="stylesheet" href="{{asset('frontend/'.App::getLocale().'/assets/vendor/slick/slick.css')}}">
    <!--====== Nice Select css ======-->
    <link rel="stylesheet"
        href="{{asset('frontend/'.App::getLocale().'/assets/vendor/nice-select/css/nice-select.css')}}">
    <!--====== Magnific-popup css ======-->
    <link rel="stylesheet"
        href="{{asset('frontend/'.App::getLocale().'/assets/vendor/magnific-popup/dist/magnific-popup.css')}}">
    <!--====== Jquery UI css ======-->
    <link rel="stylesheet" href="{{asset('frontend/'.App::getLocale().'/assets/vendor/jquery-ui/jquery-ui.min.css')}}">
    <!--====== Animate css ======-->
    <link rel="stylesheet" href="{{asset('frontend/'.App::getLocale().'/assets/vendor/aos/aos.css')}}">
    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{asset('frontend/'.App::getLocale().'/assets/css/default.css')}}">
    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{asset('frontend/'.App::getLocale().'/assets/css/style.css')}}">

    <style>
        #toast-container {
            position: fixed;
            top: 20px;
            left: 20px;
            right: auto;
            z-index: 9999;
            direction: ltr;
        }


        .toast {
            min-width: 260px;
            margin-bottom: 10px;
            padding: 14px 18px;
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .15);
            opacity: 0;
            transform: translateY(-10px);
            transition: all .35s ease;
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }

        .toast {
            opacity: 0;
            transform: translateX(-10px);
            transition: all .35s ease;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(0);
        }


        .toast-success {
            background: #2ecc71;
        }

        .toast-error {
            background: #e74c3c;
        }

        .toast-info {
            background: #3498db;
        }
    </style>
</head>

<body>
    <!--====== Preloader ======-->
    <div class="preloader">
        <div class="loader">
            <img src="{{asset('frontend/'.App::getLocale().'/assets/images/loader.gif')}}" alt="Loader">
        </div>
    </div>
    <!--======  Start Overlay  ======-->
    <div class="offcanvas__overlay"></div>
    <!--====== Start Sidemenu-wrapper-cart Area ======-->
    <div class="sidemenu-wrapper-cart">
        <div class="sidemenu-content">
            <div class="widget widget-shopping-cart">
                <h4>{{ __('home.my_cart') }}</h4>
                <div class="sidemenu-cart-close"><i class="far fa-times"></i></div>

                {{-- Container Ajax --}}
                <div id="miniCartContainer">
                    {{-- Loading placeholder --}}
                    <div class="widget-shopping-cart-content">
                        <ul class="pesco-mini-cart-list">
                            <li class="sidebar-cart-item">
                                <span class="text-muted">{{ __('home.loading') }}...</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--====== End Sidemenu-wrapper-cart Area ======-->

    <!--====== Start Header Section ======-->
    <header class="header-area">
        <!-- TOP HEADER AREA -->
        <div class="header-top ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <!--=== Header Top Left ===-->
                        <div class="top-left">
                            <ul>
                                <li class="d-lg-block d-none">
                                    <span><i class="fas fa-shipping-fast"></i>{{ __('home.free_shipping') }}</span>
                                </li>
                                <li>
                                    <div class="pesco-dropdown">
                                        <a href="javascript:void(0)"> {{ $currentCurrency->code }} <i
                                                class="far fa-angle-down"></i></a>
                                        <ul class="dropdown">
                                            @foreach($currencies as $currency)
                                            <li>
                                                <form action="{{ route('currency.change', $currency->code) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        style="background:none;border:0;padding:0;width:100%;text-align:left;">
                                                        {{ $currency->code }}
                                                        @if($currency->is_default)
                                                        <small class="text-muted">(Default)</small>
                                                        @endif
                                                    </button>
                                                </form>
                                            </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    @php
                                    $currentLocale = app()->getLocale(); // en / ar
                                    @endphp
                                    <div class="pesco-dropdown">
                                        <a href="javascript:void(0)"> {{ $currentLocale === 'ar' ? 'Arabic' : 'English'
                                            }} <i class="far fa-angle-down"></i></a>
                                        <ul class="dropdown">

                                            <li>
                                                <form action="{{ route('language.change','en') }}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        style="background:none;border:0;padding:0;width:100%;text-align:left;">
                                                        English
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('language.change','ar') }}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        style="background:none;border:0;padding:0;width:100%;text-align:left;">
                                                        Arabic
                                                    </button>
                                                </form>
                                            </li>

                                        </ul>
                                    </div>
                                </li>
                                <!-- اذا سجل وعمل لوجن اخفي ال li دي 
                                واظهري ال li 
                                اللي تحت اللي انا عامله عليها كومنت  -->
                             @guest
                                <li>
                                    <a href="{{ route('customer.login') }}"><i class="far fa-sign-in-alt"></i> Login</a>
                                </li>
                                @else
                                <!-- after login  -->
                                <li>
                                    <div class="pesco-dropdown">
                                        <a href="javascript:void(0)"> <i class="far fa-user"></i>
                                        <span style="font-size: 14px;">{{ auth()->user()->name }}</span> <i class="far fa-angle-down"></i></a>
                                        <ul class="dropdown">
                                            <li>
                                            <a href="edit-profile.html"><i class="far fa-user-edit"></i> Edit Profile</a>
                                        </li>
                                        <li>
                                            
                                         <a href="{{ route('customer.logout') }}"
                       onclick="event.preventDefault(); document.getElementById('customer-logout-form').submit();">
                        <i class="far fa-sign-out-alt"></i> Logout
                    </a>
                    <form id="customer-logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                                        </li>

                                        </ul>
                                    </div>
                                </li>
@endguest
                               
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 d-lg-block d-none">
                        <!--=== Header Top Right ===-->
                        <div class="top-right">
                            <ul>
                                <!-- <li>
                                        <span><i class="fas fa-headset"></i><a href="tel:+941234567894" class="pesco-support">+94 123 4567 894</a></span>
                                    </li> -->
                                <li>
                                    <div class="social-box">
                                        <span>{{ __('home.follow_us') }}</span>
                                        <!-- <a target="_blank" href="{{$instagram}}"><i class="fab fa-facebook-f"></i></a> -->
                                        <a target="_blank" href="{{$instagram}}"><i class="fab fa-instagram"></i></a>
                                        <a target="_blank" href="{{$snapchat}}"><i
                                                class="fab fa-snapchat-ghost"></i></a>
                                        <a target="_blank" href="{{$tiktok}}"><i class="fab fa-tiktok"></i></a>


                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--===  Search Header Main  ===-->
        <div class="search-header-main bg_cover" style="background-image: url({{asset('frontend/'.App::getLocale().'/assets/images/hero/hero-two-shape1.png')}});
    background-color: #f8f3ef;">
            <div class="container">
                <!--===  Search Header Inner  ===-->
                <div class="search-header-inner">
                    <!--=== Site Branding  ===-->
                    <div class="site-branding">
                        <a href="{{ route('home') }}" class="brand-logo"><img
                                src="{{asset('frontend/'.App::getLocale().'/assets/images/logo.png')}}" alt="Logo">
                            <span class="text-logoo">
                                Chine Boutique
                            </span>
                        </a>
                    </div>
                    <!--===  Product Search Category  ===-->
                    <div class="product-search-category">
                        <form action="#">
                            <select class="wide">
                                <option>{{ __('home.all_categories') }}</option>
                                @foreach($headerDropdownCategories as $headerDropdownCategory)
                                <option>@if (App::isLocale('en')) {{$headerDropdownCategory->name_en}}@else
                                    {{$headerDropdownCategory->name_ar}}@endif</option>
                                @endforeach

                            </select>
                            <div class="form-group">
                                <input type="text" placeholder="Enter Search Products">
                                <button class="search-btn"><i class="far fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <!--===  Hotline Support  ===-->
                    <div class="hotline-support item-rtl">
                        <div class="icon">
                            <i class="flaticon-support"></i>
                        </div>
                        <div class="info">
                            <span>24/7 Support</span>
                            <h5><a href="tel:{{$phone}}">{{$phone}}</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--===  Header Navigation  ===-->
        <div class="header-navigation style-one">
            <div class="container">
                <!--=== Primary Menu ===-->
                <div class="primary-menu">
                    <div class="site-branding d-lg-none d-block">
                        <a href="{{ route('home') }}" class="brand-logo"><img
                                src="{{asset('frontend/'.App::getLocale().'/assets/images/logo.png')}}" alt="Logo">
                            <span class="text-logoo">
                                Chine Boutique
                            </span>
                        </a>
                    </div>
                    <!--=== Nav Inner Menu ===-->
                    <div class="nav-inner-menu">
                        <!--=== Main Category ===-->
                        <div class="main-categories-wrap d-none d-lg-block">
                            <a class="categories-btn-active" href="#">
                                <span class="fas fa-list"></span><span class="text">{{ __('home.Products_Category') }}<i
                                        class="fas fa-angle-down"></i></span>
                            </a>
                            <div class="categories-dropdown-wrap categories-dropdown-active">
                                <div class="categori-dropdown-item">
                                    <ul>
                                        @foreach($homeSidebarCategories as $homeSidebarCategory)
                                        <li>
                                            <a href="{{ route('category.products', $homeSidebarCategory->slug) }}"> <img
                                                    src="{{ asset($homeSidebarCategory->image) }}"
                                                    alt="  @if (App::isLocale('en')) {{$homeSidebarCategory->name_en}}@else {{$homeSidebarCategory->name_ar}}@endif">
                                                @if (App::isLocale('en')) {{$homeSidebarCategory->name_en}}@else
                                                {{$homeSidebarCategory->name_ar}}@endif</a>
                                        </li>
                                        @endforeach



                                    </ul>
                                </div>
                                <div class="more_slide_open">
                                    <div class="categori-dropdown-item">
                                        <ul>
                                            <li>
                                                <a href="#"><img src="assets/images/icon/jacket.png"
                                                        alt="Jackets">Jackets</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="more_categories"><span class="icon"></span> <span>Show more...</span></div>
                            </div>
                        </div>
                        <!--=== Pesco Nav Main ===-->
                        <div class="pesco-nav-main">
                            <!--=== Pesco Nav Menu ===-->
                            <div class="pesco-nav-menu">
                                <!--=== Responsive Menu Search ===-->
                                <div class="nav-search mb-40 d-block d-lg-none">
                                    <div class="form-group">
                                        <input type="search" class="form_control" placeholder="Search Here"
                                            name="search">
                                        <button class="search-btn"><i class="far fa-search"></i></button>
                                    </div>
                                </div>
                                <!--=== Responsive Menu Tab ===-->
                                <div class="pesco-tabs style-three d-block d-lg-none">
                                    <ul class="nav nav-tabs mb-30" role="tablist">
                                        <li>
                                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav1"
                                                role="tab">Menu</button>
                                        </li>
                                        <li>
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav2"
                                                role="tab">Category</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="nav1">
                                            <nav class="main-menu">
                                                <ul>
                                                    <li class="menu-item"><a href="{{ route('home') }}">{{
                                                            __('home.home') }}</a>
                                                    </li>
                                                    <li class="menu-item has-children"><a href="#">{{ __('home.brands')
                                                            }}</a>
                                                        <ul class="sub-menu">
                                                            @foreach($topBrands as $topBrand)
                                                            <li><a href="{{ route('brand.products', $topBrand->slug) }}">
                                                                    @if (App::isLocale('en'))
                                                                    {{$topBrand->name_en}}@else
                                                                    {{$topBrand->name_ar}}@endif
                                                                </a></li>
                                                            @endforeach

                                                        </ul>
                                                    </li>
                                                    <li class="menu-item"><a href="#">Blog</a>
                                                    </li>
                                                    <li class="menu-item"><a href="{{ route('page.show', 'about') }}">About Us</a>
                                                    </li>
                                                    <li class="menu-item"><a href="#">Contact Us</a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="tab-pane fade" id="nav2">
                                            <div class="categori-dropdown-item">
                                                <ul>
                                                    <li>
                                                        <a href="#"> <img src="assets/images/icon/shirt.png"
                                                                alt="Shirts">Man Shirts</a>
                                                    </li>
                                                    <li>
                                                        <a href="#"> <img src="assets/images/icon/denim.png"
                                                                alt="Jeans">Denim Jeans</a>
                                                    </li>
                                                    <li>
                                                        <a href="#"> <img src="assets/images/icon/suit.png"
                                                                alt="Suit">Casual Suit</a>
                                                    </li>
                                                    <li>
                                                        <a href="#"> <img src="assets/images/icon/dress.png"
                                                                alt="Dress">Summer Dress</a>
                                                    </li>
                                                    <li>
                                                        <a href="#"> <img src="assets/images/icon/sweaters.png"
                                                                alt="Sweaters">Sweaters</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--===  Hotline Support  ===-->
                                <div class="hotline-support d-flex d-lg-none mt-30">
                                    <div class="icon">
                                        <i class="flaticon-support"></i>
                                    </div>
                                    <div class="info">
                                        <span>24/7 Support</span>
                                        <h5><a href="tel:{{$phone}}">{{$phone}}</a></h5>
                                    </div>
                                </div>
                                <!--=== Main Menu ===-->
                                <nav class="main-menu d-none d-lg-block">
                                    <ul>
                                        <li class="menu-item"><a href="{{ route('home') }}">{{ __('home.home') }}</a>
                                        </li>
                                        <li class="menu-item has-children"><a href="#">{{ __('home.brands') }}</a>
                                            <ul class="sub-menu">
                                               @foreach($topBrands as $topBrand)
    <li>
        <a href="{{ route('brand.products', $topBrand->slug) }}">
            @if (App::isLocale('en'))
                {{ $topBrand->name_en }}
            @else
                {{ $topBrand->name_ar }}
            @endif
        </a>
    </li>
@endforeach


                                            </ul>
                                        </li>


                                        <li class="menu-item"><a href="#">Blog</a>
                                        </li>
                                        <li class="menu-item"><a href="{{ route('page.show', 'about') }}">About Us</a>
                                        </li>
                                        <li class="menu-item"><a href="#">Contact Us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!--=== Nav Right Item ===-->
                    <div class="nav-right-item style-one">
                        <ul>
@guest

                               <li>
                                <div class="wishlist-btn d-lg-block ">
                                    <a href="{{ route('customer.login') }}"><i class="far fa-user"></i></a>
                                </div>
                            </li>
                           
@endguest
                            <li>
                                <div class="wishlist-btn d-lg-block ">
                                    <a href="{{ route('wishlist.index') }}"><i class="far fa-heart"></i><span
                                            class="pro-count" data-wishlist-count>{{ $wishlistCount ?? 0 }}</span>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="cart-button d-flex align-items-center">
                                    <div class="icon">
                                        <i class="fas fa-shopping-bag"></i>
                                        <span class="pro-count" data-cart-count>{{ $cartCount ?? 0 }}</span>
                                    </div>
                                </div>
                            </li>

                        </ul>
                        <div class="navbar-toggler d-block d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header><!--====== End Header Section ======-->
    <!--====== Main Bg  ======-->
    @yield('content')
    <!--====== Start Footer Main  ======-->
    <footer class="footer-main">
        <!--=== Footer Bg Wrapper  ===-->
        <div class="footer-bg-wrapper gray-bg">
            <div class="footer-shape shape-one"><span><img
                        src="{{asset('frontend/'.App::getLocale().'/assets/images/footer/shape-1.png')}}"
                        alt="shape"></span>
            </div>
            <div class="footer-shape shape-one2"><span><img
                        src="{{asset('frontend/'.App::getLocale().'/assets/images/footer/shape-1.png')}}"
                        alt="shape"></span>
            </div>
            <svg id="footer-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 75" fill="none">
                <path
                    d="M1888.99 40.9061C1901.65 33.5506 1917.87 10.0999 1920 0.000160217L2.48878 0.110695C-18.5686 5.37782 100.829 31.8098 104.136 32.5745C126.908 37.8407 182.163 45.7157 196.02 59.5798C199.049 62.6106 214.802 72.2205 222.15 72.2205C228.696 72.2205 237.893 62.3777 241.388 59.5798C254.985 48.6964 317.621 62.748 338.154 55.5577C378.089 41.5729 396.6 21.3246 452.148 27.4033C469.55 29.3076 497.787 39.4201 516.467 36.022C529.695 33.6155 539.612 26.7953 554.369 23.9558C576.978 19.6057 584.786 12.6555 612.371 13.0388C629.18 13.2724 648.084 27.6499 658.6 33.8673C672.059 41.8242 673.268 47.0554 692.77 41.4805C711.954 35.9964 746.756 38.27 766.852 40.0441C779.483 41.1593 819.866 52.3111 831.458 47.8009C837.236 45.5528 840.64 43.5162 847.537 41.3369C869.486 34.402 905.397 34.0022 929.946 38.6077C947.224 41.8489 987.666 45.9365 999.721 52.9722C1005.16 56.1489 1004.78 60.6539 1010.35 63.6019C1018.09 67.7037 1021.56 68.3083 1029.01 67.4803C1042.77 65.9505 1045.29 61.7272 1056.86 58.1434C1090.94 47.59 1121.71 32.7536 1160.52 26.5415C1182.98 22.9457 1193.92 36.1401 1209.04 41.4806C1240.16 52.468 1262.92 57.9972 1299.78 49.2374C1331.73 41.6466 1369.13 23.3813 1405.73 23.3813C1419.55 23.3813 1427.96 32.734 1435.31 37.4585C1451.38 47.7919 1467 56.9943 1493.89 56.9943C1532.36 56.9943 1544.2 49.9853 1574.29 39.0386C1588.58 33.8384 1616.86 22.826 1635.73 23.3813C1651.4 23.8424 1656.97 43.603 1667.89 48.6629C1683.26 55.7835 1710.61 49.5903 1723.88 43.7789C1736.22 38.3771 1758.43 20.6985 1777.29 30.1327C1788.48 35.7274 1794.71 53.9926 1801.12 61.5909C1815.62 78.7687 1819.96 77.5598 1843.05 68.4859C1861.58 61.2028 1873.63 49.8315 1888.99 40.9061Z"
                    fill="#FFFAF3" />
            </svg>
            <!--=== Footer Widget Area  ===-->
            <div class="footer-widget-area pb-4">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6">
                            <!--=== Footer Widget  ===-->
                            <div class="footer-widget about-company-widget mb-40" data-aos="fade-up" data-aos-delay="10"
                                data-aos-duration="1000">
                                <div class="widget-content">

                                    <a href="{{ route('home') }}" class="footer-logo text-center "><img
                                            src="{{asset('frontend/'.App::getLocale().'/assets/images/logo.png')}}"
                                            width="100px" alt="Logo">
                                        <span class="text-logoo mt-2">
                                            Chine Boutique
                                        </span>
                                    </a>

                                    <ul class="ct-info-list mb-30">
                                        <li>
                                            <i class="fas fa-envelope"></i>
                                            <a href="mailto:{{$email}}">{{$email}}</a>
                                        </li>
                                        <li>
                                            <i class="fas fa-phone-alt"></i>
                                            <a href="tel:{{$phone}}">{{$phone}}</a>
                                        </li>

                                    </ul>
                                    <ul class="social-link">
                                        <li>
                                            <span>{{ __('home.follow_us') }}:</span>
                                        </li>
                                        <!-- <li>
                                            <a href="{{$tiktok}}"><i class="fab fa-facebook-f"></i></a>
                                        </li> -->
                                        <li>
                                            <a href="{{$instagram}}"><i class="fab fa-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a href="{{$tiktok}}"><i class="fab fa-tiktok"></i></a>
                                        </li>
                                        <li>
                                            <a href="{{$snapchat}}"><i class="fab fa-snapchat-ghost"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-6">
                            <!--=== Footer Widget ===-->
                            <div class="footer-widget footer-nav-widget mb-40" data-aos="fade-up" data-aos-delay="15"
                                data-aos-duration="1200">
                                <div class="widget-content">
                                    <h4 class="widget-title">{{ __('home.Customer_Services') }}</h4>
                                    <ul class="widget-menu">
                                        <li><img src="{{asset('frontend/'.App::getLocale().'/assets/images/icon/star-3.svg')}}"
                                                alt="star icon"><a href="{{ route('categories') }}">
                                                {{ __('home.all_Categories') }}</a></li>
                                        <li><img src="{{asset('frontend/'.App::getLocale().'/assets/images/icon/star-3.svg')}}"
                                                alt="star icon"><a href="{{ route('brands') }}">
                                                {{ __('home.all_brands') }}</a></li>
                                        <li><img src="{{asset('frontend/'.App::getLocale().'/assets/images/icon/star-3.svg')}}"
                                                alt="star icon"><a href="{{ route('home') }}#workProcess">
                                                {{ __('home.Work_Processing') }}</a></li>
                                        <li><img src="{{asset('frontend/'.App::getLocale().'/assets/images/icon/star-3.svg')}}"
                                                alt="star icon"><a href="#">
                                                {{ __('home.faq') }}</a>
                                        </li>



                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-6">
                            <!--=== Footer Widget ===-->
                            <div class="footer-widget footer-nav-widget mb-40" data-aos="fade-up" data-aos-delay="20"
                                data-aos-duration="1400">
                                <div class="widget-content">
                                    <h4 class="widget-title">Quick Link</h4>
                                    <ul class="widget-menu">
                                        <li><img src="{{asset('frontend/'.App::getLocale().'/assets/images/icon/star-3.svg')}}"
                                                alt="star icon"><a href="#">Contact</a></li>
                                        <li><img src="{{asset('frontend/'.App::getLocale().'/assets/images/icon/star-3.svg')}}"
                                                alt="star icon"><a href="{{ route('customer.login') }}">Login /
                                                Register</a></li>
                                        <li><img src="{{asset('frontend/'.App::getLocale().'/assets/images/icon/star-3.svg')}}"
                                                alt="star icon"><a href="{{ route('page.show', 'privacy_policy') }}">Privacy
                                                Policy</a></li>
                                        <li><img src="{{asset('frontend/'.App::getLocale().'/assets/images/icon/star-3.svg')}}"
                                                alt="star icon"><a href="{{ route('page.show', 'terms_and_condition') }}">Terms &
                                                Conditions</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <!--=== Footer Widget  ===-->
                            <div class="footer-widget footer-recent-post-widget" data-aos="fade-up" data-aos-delay="25"
                                data-aos-duration="1600">
                                <h4 class="widget-title">Recent Blog</h4>
                                <div class="widget-content">
                                    <div class="recent-post-item">
                                        <div class="thumb">
                                            <img src="assets/images/footer/recent-post-1.png" alt="post thumb">
                                        </div>
                                        <div class="content">
                                            <h4><a href="#">Tips on Finding Affordable Fashion Gems Online</a></h4>
                                            <span><a href="#">July 11, 2023</a></span>
                                        </div>
                                    </div>
                                    <div class="recent-post-item">
                                        <div class="thumb">
                                            <img src="assets/images/footer/recent-post-2.png" alt="post thumb">
                                        </div>
                                        <div class="content">
                                            <h4><a href="#">Mastering the Art of Fashion E-commerce Marketing</a></h4>
                                            <span><a href="#">JUly 11, 2024</a></span>
                                        </div>
                                    </div>
                                    <div class="recent-post-item">
                                        <div class="thumb">
                                            <img src="assets/images/footer/recent-post-3.png" alt="post thumb">
                                        </div>
                                        <div class="content">
                                            <h4><a href="#">Must-Have Trends You Can Shop Online Now</a></h4>
                                            <span><a href="#">July 11, 2024</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--=== Footer Copyright  ===-->
            <div class="copyright-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="copyright-text">
                                <p>&copy;
                                    <?php echo date('Y');?>. All rights reserved by <span>chine boutique</span>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </footer><!--====== End Footer Main  ======-->
    <!--====== Back To Top  ======-->
    <div class="back-to-top"><i class="far fa-angle-up"></i></div>
    <!--====== Jquery js ======-->
    <script src="{{asset('frontend/'.App::getLocale().'/assets/vendor/jquery-3.7.1.min.js')}}"></script>
    <!--====== Bootstrap js ======-->
    <script src="{{asset('frontend/'.App::getLocale().'/assets/vendor/popper/popper.min.js')}}"></script>
    <!--====== Bootstrap js ======-->
    <script src="{{asset('frontend/'.App::getLocale().'/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--====== Slick js ======-->
    <script src="{{asset('frontend/'.App::getLocale().'/assets/vendor/slick/slick.min.js')}}"></script>
    <!--====== Magnific js ======-->
    <script
        src="{{asset('frontend/'.App::getLocale().'/assets/vendor/magnific-popup/dist/jquery.magnific-popup.min.js')}}"></script>
    <!--====== Nice-select js ======-->
    <script
        src="{{asset('frontend/'.App::getLocale().'/assets/vendor/nice-select/js/jquery.nice-select.min.js')}}"></script>
    <!--====== Jquery Ui js ======-->
    <script src="{{asset('frontend/'.App::getLocale().'/assets/vendor/jquery-ui/jquery-ui.min.js')}}"></script>
    <!--====== SimplyCountdown js ======-->
    <script src="{{asset('frontend/'.App::getLocale().'/assets/vendor/simplyCountdown.min.js')}}"></script>
    <!--====== Aos js ======-->
    <script src="{{asset('frontend/'.App::getLocale().'/assets/vendor/aos/aos.js')}}"></script>
    <!--====== Main js ======-->
    <script src="{{asset('frontend/'.App::getLocale().'/assets/js/theme.js')}}"></script>




    <script>
        async function loadMiniCart() {
            const res = await fetch("{{ route('cart.mini') }}", {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const html = await res.text();
            document.getElementById('miniCartContainer').innerHTML = html;


            const container = document.querySelector('#miniCartContainer .widget-shopping-cart-content');
            if (container) {
                const count = container.getAttribute('data-items-count') || 0;
                const badge = document.querySelector('[data-cart-count]');
                if (badge) badge.textContent = count;
            }
        }

        document.addEventListener('click', async function (e) {
            const btn = e.target.closest('.js-mini-remove');
            if (!btn) return;

            e.preventDefault();

            const url = btn.getAttribute('data-remove-url');
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const res = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const html = await res.text();
            document.getElementById('miniCartContainer').innerHTML = html;
        });


        document.addEventListener('DOMContentLoaded', loadMiniCart);


        window.refreshMiniCart = loadMiniCart;
    </script>

    <script>
        document.addEventListener('click', async function (e) {
            const btn = e.target.closest('.js-add-to-cart');
            if (!btn) return;
            e.stopPropagation();
            e.preventDefault();

            const url = btn.getAttribute('data-url');
            const qtySelector = btn.getAttribute('data-qty-input');
            let qty = 1;

            if (qtySelector) {
                const qtyInput = document.querySelector(qtySelector);
                if (qtyInput) {
                    qty = parseInt(qtyInput.value || '1', 10);
                    if (isNaN(qty) || qty < 1) qty = 1;
                }
            }

            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            btn.classList.add('disabled');

            try {
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ qty })
                });

                if (!res.ok) throw new Error('Request failed');

                if (window.refreshMiniCart) {
                    window.refreshMiniCart();
                }

                //   document.querySelector('.sidemenu-wrapper-cart')?.classList.add('active');

                showToast("{{ __('home.added_to_cart') }}", 'success');

            } catch (err) {
                showToast("{{ __('home.add_to_cart_failed') }}", 'error');
            }
            finally {
                btn.classList.remove('disabled');
            }
        });
    </script>

    <div id="toast-container"></div>
    <script>
        function showToast(message, type = 'success', duration = 3000) {
            const container = document.getElementById('toast-container');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;
            toast.textContent = message;

            container.appendChild(toast);

            // show
            setTimeout(() => toast.classList.add('show'), 50);

            // hide
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 400);
            }, duration);
        }
    </script>
    <script>
        document.addEventListener('click', async function (e) {
            const btn = e.target.closest('.js-wishlist-toggle');
            if (!btn) return;

            e.preventDefault();
            e.stopPropagation();


            if (btn.classList.contains('disabled')) return;

            const url = btn.getAttribute('data-url');
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            btn.classList.add('disabled');

            try {
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });


                let data = null;
                try {
                    data = await res.json();
                } catch (jsonErr) {
                    throw new Error('Invalid JSON response');
                }


                if (!res.ok || (data.ok !== undefined && !data.ok)) throw new Error('failed');

                const status = data.status; // 'added' | 'removed'

                // ✅ toggle active class
                if (status === 'added') btn.classList.add('is-active');
                else btn.classList.remove('is-active');

                // ✅ change icon (fa solid / far regular)
                const icon = btn.querySelector('i');
                if (icon) {
                    icon.className = (status === 'added') ? 'fa fa-heart' : 'far fa-heart';
                }

                // ✅ update wishlist count in header
                const badge = document.querySelector('[data-wishlist-count]');
                if (badge) badge.textContent = (data.count ?? 0);

                // ✅ toast message
                showToast(data.message || "{{ __('home.updated') }}", status === 'added' ? 'success' : 'info');

            } catch (err) {
                showToast("{{ __('home.wishlist_failed') }}", 'error');
                // console.log(err);
            } finally {
                btn.classList.remove('disabled');
            }
        });
    </script>

    @stack('scripts')

</body>

</html>