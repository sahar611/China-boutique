@extends('front.layouts.main_layout')

@section('content')
<main class="main-bg">
        <!--====== Start Hero Section ======-->
        <section class="hero-section">
            <!--=== Hero Wrapper ===-->
            <div class="hero-wrapper-two">
                <!--=== Hero shape ===-->
                <div class="hero-shape bg_cover d-none d-xl-block"
                    style="background-image: url({{asset('frontend/'.App::getLocale().'/assets/images/hero/hero-two-shape1.png')}});"></div>
                <!--=== Hero Image ===-->
                <div class="hero-image d-none d-xl-block">
                    <img src="{{asset('frontend/'.App::getLocale().'/assets/images/PM.jpeg')}}" alt="Hero Image">
                    <div class="hero-img-shape"><img src="{{asset('frontend/'.App::getLocale().'/assets/images/hero/hero-two-img-shape1.png')}}" alt="Image Shape">
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6">
                            <!--=== hero Post Slider ===-->
                            <div class="hero-post-slider mb-50">
                                @foreach($heroBanner as $banner)
                                @php
    $titlee = app()->getLocale() == 'ar'
        ? $banner->title_ar
        : $banner->title;

    $words = explode(' ', trim($titlee));

    $firstWords = implode(' ', array_slice($words, 0, 3));
    $restWords  = implode(' ', array_slice($words, 3));
@endphp
                                <!--=== Single Post Slider ===-->
                                <div class="single-hero-post">
                                    <div class="hero-content style-two">
                                        <span class="tag-line"><i class="flaticon-star-2"></i><b>Best for your
                                                categories</b><i class="flaticon-star-2"></i></span>
                                        <h1><span>{{ $firstWords }}</span>{{ $restWords }}</h1>
                                        <p>{{ app()->getLocale() == 'ar' ? $banner->description_ar : $banner->description }} </p>
                                        <a href="{{ $banner->link ?? '#' }}" class="theme-btn style-one">{{ __('home.shop_now') }}</a>
                                    </div>
                                </div>
                              @endforeach
                            </div>
                            <!--=== Hero Dots ===-->
                            <div class="hero-dots text-center text-xl-start pb-5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--====== End Hero Section ======-->
        <!--====== Start Animated-headline Section ======-->
        <section class="animated-headline-area primary-dark-bg pt-25 pb-25">
            <div class="headline-wrap style-one">
                <span class="marquee-wrap">
                    <span class="marquee-inner left">
                        @foreach($homeTabsCategories as $homeTabsCategory)
                        <span class="marquee-item"> <a href="#" class="hover-c"><b>@if (App::isLocale('en')) {{$homeTabsCategory->name_en}}@else {{$homeTabsCategory->name_ar}}@endif</b></a><i
                                class="fas fa-bahai"></i></span>
                       @endforeach
                    </span>
                     <span class="marquee-inner left">
                        @foreach($homeTabsCategories as $homeTabsCategory)
                        <span class="marquee-item"> <a href="#" class="hover-c"><b>@if (App::isLocale('en')) {{$homeTabsCategory->name_en}}@else {{$homeTabsCategory->name_ar}}@endif</b></a><i
                                class="fas fa-bahai"></i></span>
                       @endforeach
                    </span>
                     <span class="marquee-inner left">
                        @foreach($homeTabsCategories as $homeTabsCategory)
                        <span class="marquee-item"> <a href="#" class="hover-c"><b>@if (App::isLocale('en')) {{$homeTabsCategory->name_en}}@else {{$homeTabsCategory->name_ar}}@endif</b></a><i
                                class="fas fa-bahai"></i></span>
                       @endforeach
                    </span>
                
                </span>
            </div>
        </section><!--====== End Animated-headline Section ======-->
        <!--====== Start Category Section ======-->
        <section class="category-section pt-5 pb-2 overflow-hidden">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-8">
                        <!--=== Section Title ===-->
                        <div class="section-title mb-30" data-aos="fade-right" data-aos-delay="10"
                            data-aos-duration="800">
                            <div class="sub-heading d-inline-flex align-items-center">
                                <i class="flaticon-sparkler"></i>
                                <span class="sub-title">{{ __('home.Categories') }}</span>
                            </div>
                            <h2>{{ __('home.Browse_Top_Category') }}</h2>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4">
                        <!--=== Arrows ===-->
                        <div class="category-arrows style-one mb-60" data-aos="fade-left" data-aos-delay="15"
                            data-aos-duration="1000"></div>
                    </div>
                </div>
            </div>
            <!--=== Category Slider ===-->
            <div class="category-slider-one" data-aos="fade-up" data-aos-delay="20" data-aos-duration="1200">
                @foreach($topCategories as $topCategory)
                <!--=== Category Item ===-->
                <div class="category-item style-one text-center">
                    <div class="category-img">
                        <img src="{{ asset($topCategory->image) }}" alt="@if (App::isLocale('en')) {{$topCategory->name_en}}@else {{$topCategory->name_ar}}@endif">
                    </div>
                    <div class="category-content">
                        <a href="index.html" class="category-btn">@if (App::isLocale('en')) {{$topCategory->name_en}}@else {{$topCategory->name_ar}}@endif</a>
                    </div>
                </div>
               @endforeach
               
             
            </div>
        </section><!--====== End Category Section ======-->
        <!--===== Start brand Section  ======-->
        <section class="category-section pt-5 pb-2 overflow-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <!--=== Section Title  ===-->
                        <div class="section-title  text-center text-md-start mb-50" data-aos="fade-right"
                            data-aos-delay="10" data-aos-duration="1000">
                            <div class="sub-heading d-inline-flex align-items-center">
                                <i class="flaticon-sparkler"></i>
                                <span class="sub-title">{{ __('home.brands') }}</span>
                            </div>
                            <h2>{{ __('home.Browse_Top_Brands') }}</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!--=== Category Button  ===-->
                        <div class="category-button text-center float-md-end mb-60" data-aos="fade-left"
                            data-aos-delay="15" data-aos-duration="1200">
                            <a href="#" class="theme-btn style-one">{{ __('home.View_All') }} <i
                                    class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <!--====== Start Category Wrapper ======-->
                <div class="category-wrapper pt-80">
                    <div class="row justify-content-center">
                          @foreach($topBrands as $topBrand)
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                            <!--=== Category Item  ===-->
                            <div class="category-item style-two mb-2 back-red-h" data-aos="fade-up" data-aos-delay="10"
                                data-aos-duration="800">
                                <div class="category-img">
                                    <img src="{{ asset($topBrand->logo) }}" alt="@if (App::isLocale('en')) {{$topBrand->name_en}}@else {{$topBrand->name_ar}}@endif">
                                </div>
                                <div class="category-content">
                                    <a href="index.html" class="category-btn"> @if (App::isLocale('en')) {{$topBrand->name_en}}@else {{$topBrand->name_ar}}@endif</a>
                                    <span>{{ $topBrand->products_count }} {{ __('home.items') }}</span>
                                </div>
                            </div>
                        </div>
                     @endforeach
                    </div>
                </div>
            </div>
        </section><!--===== End brand Section  ======-->
        <!--====== Start Features Section ======-->
        <section class="features-products pt-5 pb-2 overflow-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <!--=== Section Title ===-->
                        <div class="section-title mb-30 text-center text-lg-start" data-aos="fade-right"
                            data-aos-delay="10" data-aos-duration="1000">
                            <div class="sub-heading d-inline-flex align-items-center">
                                <i class="flaticon-sparkler"></i>
                                <span class="sub-title">{{ __('home.Feature_Products') }}</span>
                            </div>
                            <h2>{{ __('home.Our_Features_Collection') }}</h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!--=== Pesco Tabs ===-->
                        <div class="pesco-tabs style-one mb-50" data-aos="fade-left" data-aos-delay="15"
                            data-aos-duration="1200">
                            <ul class="nav nav-tabs" role="tablist">
                                <li>
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#cat1"
                                        role="tab">{{ __('home.Best_Sellers') }}</button>
                                </li>
                                <li>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#cat2" role="tab">{{ __('home.New_Products') }}</button>
                                </li>
                                <li>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#cat3" role="tab">{{ __('home.Sale_Products') }}</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!--=== Tab Content ===-->
                        <div class="tab-content" data-aos="fade-up" data-aos-duration="1200">
                            <!--=== Tab Pane  ===-->
                            <div class="tab-pane fade show active" id="cat1">
                                <div class="row justify-content-center">
                                    @foreach($bestSellers as $bestSeller)
                                    <div class="col-xl-3 col-lg-4 col-sm-6">
                                        <!--=== Product Item  ===-->
                                        <div class="product-item style-one mb-40 back-p">
                                            <div class="product-thumbnail">
                                                <img src="{{ $bestSeller->mainImageProduct
        ? asset($bestSeller->mainImageProduct->path)
        : asset('assets/images/products/default.png') }}"
                                                    alt="Products">
                                                    @if($bestSeller->sale_price)
                                                <div class="discount">10% Off</div>
                                                @endif
                                                <div class="hover-content">
                                                    <a href="#" class="icon-btn"><i class="far fa-heart"></i></a>
                                                    <a href="{{ $bestSeller->mainImageProduct
        ? asset($bestSeller->mainImageProduct->path)
        : asset('assets/images/products/default.png') }}"
                                                        class="img-popup icon-btn"><i class="fa fa-eye"></i></a>
                                                </div>
                                                <div class="cart-button">
                                                    <a href="#" class="cart-btn"><i class="far fa-shopping-basket"></i>
                                                        <span class="text">{{ __('home.Add_To_Cart') }}</span></a>
                                                </div>
                                            </div>
                                            <div class="product-info-wrap">
                                                <div class="product-info">
                                                    <ul class="ratings rating5">
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><a href="#">(80)</a></li>
                                                    </ul>
                                                    <h4 class="title"><a href="#"> {{ $bestSeller->name }}</a></h4>
                                                </div>
                                                  @if($bestSeller->sale_price)
                                                <div class="product-price">
                                                    <span class="price prev-price"><span
                                                            class="currency">{{ $currentCurrency->symbol }}</span>{{ number_format($bestSeller->price * $currentCurrency->rate, 2) }}</span>
                                                    <span class="price new-price"><span
                                                            class="currency">{{ $currentCurrency->symbol }}</span>{{ number_format($bestSeller->sale_price * $currentCurrency->rate, 2) }}</span>
                                                </div>
                                                @else
                                                <div class="product-price">
                                                   
                                                    <span class="price new-price"><span
                                                            class="currency">{{ $currentCurrency->symbol }}
</span>{{ number_format($bestSeller->price * $currentCurrency->rate, 2) }}</span>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                   @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="cat2">
                                <div class="row justify-content-center">
                                   
                                   @foreach($newProducts as $newProduct)
                                    <div class="col-xl-3 col-lg-4 col-sm-6">
                                        <!--=== Product Item  ===-->
                                        <div class="product-item style-one mb-40 back-p">
                                            <div class="product-thumbnail">
                                                <img src="{{ $newProduct->mainImageProduct? asset($newProduct->mainImageProduct->path) : asset('assets/images/products/default.png') }}"
                                                    alt="Products">
                                                    @if($newProduct->sale_price)
                                                <div class="discount">10% Off</div>
                                                @endif
                                                <div class="hover-content">
                                                    <a href="#" class="icon-btn"><i class="far fa-heart"></i></a>
                                                    <a href="{{ $newProduct->mainImageProduct? asset($newProduct->mainImageProduct->path): asset('assets/images/products/default.png') }}"
                                                        class="img-popup icon-btn"><i class="fa fa-eye"></i></a>
                                                </div>
                                                <div class="cart-button">
                                                    <a href="#" class="cart-btn"><i class="far fa-shopping-basket"></i>
                                                        <span class="text">{{ __('home.Add_To_Cart') }}</span></a>
                                                </div>
                                            </div>
                                            <div class="product-info-wrap">
                                                <div class="product-info">
                                                    <ul class="ratings rating5">
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><a href="#">(80)</a></li>
                                                    </ul>
                                                    <h4 class="title"><a href="#"> {{ $newProduct->name }}</a></h4>
                                                </div>
                                                  @if($newProduct->sale_price)
                                                <div class="product-price">
                                                    <span class="price prev-price"><span
                                                            class="currency">{{ $currentCurrency->symbol }}</span>{{ number_format($newProduct->price * $currentCurrency->rate, 2) }}</span>
                                                    <span class="price new-price"><span
                                                            class="currency">{{ $currentCurrency->symbol }}</span>{{ number_format($newProduct->sale_price * $currentCurrency->rate, 2) }}</span>
                                                </div>
                                                @else
                                                <div class="product-price">
                                                   
                                                    <span class="price new-price"><span
                                                            class="currency">{{ $currentCurrency->symbol }}</span>{{ number_format($newProduct->price * $currentCurrency->rate, 2) }}</span>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                   @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="cat3">
                                <div class="row justify-content-center">
                                 
                                   @foreach($saleProducts as $saleProduct)
                                    <div class="col-xl-3 col-lg-4 col-sm-6">
                                        <!--=== Product Item  ===-->
                                        <div class="product-item style-one mb-40 back-p">
                                            <div class="product-thumbnail">
                                                <img src="{{ $saleProduct->mainImageProduct? asset($saleProduct->mainImageProduct->path) : asset('assets/images/products/default.png') }}"
                                                    alt="Products">
                                                    @if($saleProduct->sale_price)
                                                <div class="discount">10% Off</div>
                                                @endif
                                                <div class="hover-content">
                                                    <a href="#" class="icon-btn"><i class="far fa-heart"></i></a>
                                                    <a href="{{ $saleProduct->mainImageProduct? asset($saleProduct->mainImageProduct->path): asset('assets/images/products/default.png') }}"
                                                        class="img-popup icon-btn"><i class="fa fa-eye"></i></a>
                                                </div>
                                                <div class="cart-button">
                                                    <a href="#" class="cart-btn"><i class="far fa-shopping-basket"></i>
                                                        <span class="text">{{ __('home.Add_To_Cart') }}</span></a>
                                                </div>
                                            </div>
                                            <div class="product-info-wrap">
                                                <div class="product-info">
                                                    <ul class="ratings rating5">
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><a href="#">(80)</a></li>
                                                    </ul>
                                                    <h4 class="title"><a href="#"> {{ $saleProduct->name }}</a></h4>
                                                </div>
                                                  @if($saleProduct->sale_price)
                                                <div class="product-price">
                                                    <span class="price prev-price"><span
                                                            class="currency">{{ $currentCurrency->symbol }}</span>{{ number_format($saleProduct->price * $currentCurrency->rate, 2) }}</span>
                                                    <span class="price new-price"><span
                                                            class="currency">{{ $currentCurrency->symbol }}</span>{{ number_format($saleProduct->sale_price * $currentCurrency->rate, 2) }}</span>
                                                </div>
                                                @else
                                                <div class="product-price">
                                                   
                                                    <span class="price new-price"><span
                                                            class="currency">{{ $currentCurrency->symbol }}</span>{{ number_format($saleProduct->price * $currentCurrency->rate, 2) }}</span>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                   @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--====== End Features Section ======-->
        <!--====== Start Features Products Section  ======-->
        <section class="features-products-section pt-5 pb-2 overflow-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <!--=== Section Title  ===-->
                        <div class="section-title mb-30" data-aos="fade-right" data-aos-delay="10"
                            data-aos-duration="1000">
                            <div class="sub-heading d-inline-flex align-items-center">
                                <i class="flaticon-sparkler"></i>
                                <span class="sub-title">{{ __('home.Feature_Products') }}</span>
                            </div>
                            <h2>{{ __('home.Our_Products') }} </h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!--=== Arrows ===-->
                        <div class="feature-arrows style-one mb-60" data-aos="fade-left" data-aos-delay="15"
                            data-aos-duration="1200"></div>
                    </div>
                </div>
                <!--=== Feature Slider  ===-->
                <div class="feature-slider-one" data-aos="fade-up" data-aos-delay="20" data-aos-duration="1400">
              @foreach($homeProducts as $homeProduct)
                    <!--=== Project Item  ===-->
                    <div class="product-item style-one mb-40 back-p">
                        <div class="product-thumbnail">
                            <img src="{{ $homeProduct->mainImageProduct? asset($homeProduct->mainImageProduct->path) : asset('assets/images/products/default.png') }}" alt="Products">
                             @if($homeProduct->sale_price)
                                                <div class="discount">10% Off</div>
                                                @endif
                            <div class="hover-content">
                                <a href="#" class="icon-btn"><i class="fa fa-heart"></i></a>
                                <a href="{{ $homeProduct->mainImageProduct? asset($homeProduct->mainImageProduct->path) : asset('assets/images/products/default.png') }}" class="img-popup icon-btn"><i class="fa fa-eye"></i></a>
                            </div>
                            <div class="cart-button">
                                <a href="#" class="cart-btn"><i class="far fa-shopping-basket"></i> <span
                                        class="text">{{ __('home.Add_To_Cart') }}</span></a>
                            </div>
                        </div>
                        <div class="product-info-wrap">
                            <div class="product-info">
                                <ul class="ratings rating4">
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><a href="#">(50)</a></li>
                                </ul>
                                <h4 class="title"><a href="#">{{ $saleProduct->name }}</a></h4>
                            </div>
                              @if($saleProduct->sale_price)
                                                <div class="product-price">
                                                    <span class="price prev-price"><span
                                                            class="currency">{{ $currentCurrency->symbol }}</span>{{ number_format($saleProduct->price * $currentCurrency->rate, 2) }}</span>
                                                    <span class="price new-price"><span
                                                            class="currency">{{ $currentCurrency->symbol }}</span>{{ number_format($saleProduct->sale_price * $currentCurrency->rate, 2) }}</span>
                                                </div>
                                                @else
                                                <div class="product-price">
                                                   
                                                    <span class="price new-price"><span
                                                            class="currency">{{ $currentCurrency->symbol }}</span>{{ number_format($saleProduct->price * $currentCurrency->rate, 2) }}</span>
                                                </div>
                                                @endif
                        </div>
                    </div>
                   @endforeach
                </div>
            </div>
        </section><!--====== End Features Products Section  ======-->
        <!--====== Start Features Section ======-->
        <section class="features-section pt-5 pb-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--=== Features Wrapper ===-->
                        <div class="features-wrapper" data-aos="fade-up" data-aos-delay="10" data-aos-duration="1000">
                            <!--=== Iconic Box Item ===-->
                            <div class="iconic-box-item icon-left-box mb-25">
                                <div class="icon">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                                <div class="content">
                                    <h5>Free Shipping</h5>
                                    <p>You get your items delivered without any extra cost.</p>
                                </div>
                            </div>
                            <!--=== Divider ===-->
                            <div class="divider mb-25">
                                <img src="{{asset('frontend/'.App::getLocale().'/assets/images/divider.png')}}" alt="divider">
                            </div>
                            <!--=== Iconic Box Item ===-->
                            <div class="iconic-box-item icon-left-box mb-25">
                                <div class="icon">
                                    <i class="fas fa-microphone"></i>
                                </div>
                                <div class="content">
                                    <h5>Great Support 24/7</h5>
                                    <p>Our customer support team is available around the clock </p>
                                </div>
                            </div>
                            <!--=== Divider ===-->
                            <div class="divider mb-25">
                                <img src="{{asset('frontend/'.App::getLocale().'/assets/images/divider.png')}}" alt="divider">
                            </div>
                            <!--=== Iconic Box Item ===-->
                            <div class="iconic-box-item icon-left-box mb-25">
                                <div class="icon">
                                    <i class="far fa-handshake"></i>
                                </div>
                                <div class="content">
                                    <h5>Return Available</h5>
                                    <p>Making it easy to return any items if you're not satisfied.</p>
                                </div>
                            </div>
                            <!--=== Divider ===-->
                            <div class="divider mb-25">
                                <img src="{{asset('frontend/'.App::getLocale().'/assets/images/divider.png')}}" alt="divider">
                            </div>
                            <!--=== Iconic Box Item ===-->
                            <div class="iconic-box-item icon-left-box mb-25">
                                <div class="icon">
                                    <i class="fas fa-sack-dollar"></i>
                                </div>
                                <div class="content">
                                    <h5>Secure Payment</h5>
                                    <p>Shop with confidence knowing that our secure payment</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--====== End Features Section ======-->

        <!--====== Start Banner Section ======-->
        <section class="banner-section pt-5 pb-2">
            <div class="container">
                <div class="row">
                     @foreach($promoBanners as $banner)
                    <div class="col-lg-6">
                        <!--=== Banner Item ===-->
                        <div class="banner-item style-one bg-one mb-40" data-aos="fade-up" data-aos-delay="10"
                            data-aos-duration="900">
                            <div class="shape shape-one"><span><img src="{{asset('frontend/'.App::getLocale().'/assets/images/banner/discount.png')}}"
                                        alt="shape"></span></div>
                            <div class="shape shape-two"><span><img src="{{asset('frontend/'.App::getLocale().'/assets/images/banner/line.png')}}"
                                        alt="shape"></span></div>
                            <div class="banner-img"><img src="{{ $banner->image ? asset($banner->image) : asset('assets/images/banner/banner-1.png') }}" alt="banner image">
                            </div>
                            <div class="banner-content">
                                <span>{{ __('home.up_to') }} <span class="off">{{ $banner->discount_percent }}%</span></span>
                                <h4> {{ $banner->title }}</br>{{ $banner->subtitle }}</h4>
                                <a href="{{ $banner->link ?? '#' }}" class="theme-btn style-one">{{ __('home.shop_now') }}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section><!--====== End Banner Section ======-->

        <!--====== Start Trending Products Sections  ======-->
        <section class="trending-products-section pt-5 pb-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <!--=== Section Title  ===-->
                        <div class="section-title mb-30" data-aos="fade-right" data-aos-duration="1000">
                            <div class="sub-heading d-inline-flex align-items-center">
                                <i class="flaticon-sparkler"></i>
                                <span class="sub-title">{{ __('home.Trending_Products') }}</span>
                            </div>
                            <h2>{{ __("home.What's_Trending_Now") }}</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!--=== Arrows ===-->
                        <div class="trending-product-arrows style-one mb-60" data-aos="fade-left"
                            data-aos-duration="1200"></div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="trending-products-slider" data-aos="fade-up" data-aos-duration="1400">
                   @foreach($trendingNow as $trending)
                    <!--=== Product Item ===-->
                    <div class="product-item style-two">
                        <div class="product-thumbnail">
                            <img src="{{ $trending->mainImageProduct? asset($trending->mainImageProduct->path) : asset('assets/images/products/default.png') }}" alt="Products">
                        </div>
                        <div class="product-info-wrap">
                            <div class="product-info">
                                <ul class="ratings rating5">
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><a href="#">(80)</a></li>
                                </ul>
                                <h4 class="title"><a href="#">{{ $trending->name }}</a></h4>
                            </div>
                             @if($trending->sale_price)
                                                <div class="product-price">
                                                    <span class="price prev-price"><span
                                                            class="currency">{{ $currentCurrency->symbol }}</span>{{ number_format($trending->price * $currentCurrency->rate, 2) }}</span>
                                                    <span class="price new-price"><span
                                                            class="currency">{{ $currentCurrency->symbol }}</span>{{ number_format($trending->sale_price * $currentCurrency->rate, 2) }}</span>
                                                </div>
                                                @else
                                                <div class="product-price">
                                                   
                                                    <span class="price new-price"><span
                                                            class="currency">{{ $currentCurrency->symbol }}</span>{{ number_format($trending->price * $currentCurrency->rate, 2) }}</span>
                                                </div>
                                                @endif
                        </div>
                    </div>
                   @endforeach
                   
                </div>
            </div>
        </section><!--====== End Trending Products Sections  ======-->

        <!--====== Start Working Section  ======-->
        <section class="work-processing-section pt-5 pb-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--=== Section Title  ===-->
                        <div class="section-title text-center mb-60" data-aos="fade-up" data-aos-delay="10"
                            data-aos-duration="800">
                            <div class="sub-heading d-inline-flex align-items-center">
                                <i class="flaticon-sparkler"></i>
                                <span class="sub-title">{{ __('home.work_processing') }}</span>
                                <i class="flaticon-sparkler"></i>
                            </div>
                            <h2>{{ __('home.how_it_work') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                     @foreach($workSteps as $s)
                    <div class="col-xl-3 col-sm-6">
                        <!--=== Iconic Box Item  ===-->
                        <div class="iconic-box-item style-two mb-40" data-aos="fade-up" data-aos-duration="1000">
                            <div class="sn-number">{{ str_pad($s->step_no,2,'0',STR_PAD_LEFT) }}</div>
                            <div class="icon">
                                @if($s->icon_type === 'image' && $s->icon_image)
                  <img src="{{ asset($s->icon_image) }}" alt="icon">
                @else
                  <i class="{{ $s->icon_class }}"></i>
                @endif
                            </div>
                            <div class="content">
                                <h6>{{ app()->getLocale()=='ar' ? $s->title_ar : $s->title_en }}</h6>
                                <p>{{ app()->getLocale()=='ar' ? $s->desc_ar : $s->desc_en }}</p>
                            </div>
                        </div>
                    </div>
                   @endforeach
                </div>
            </div>
        </section><!--====== End Working Section  ======-->
        <!--====== Start Newsletter Section ======-->
        <section class="newsletter-section">
            <div class="newsletter-wrapper-two p-r z-1 pt-80 pb-85">
                <div class="newsletter-image-two" data-aos="fade-left" data-aos-duration="1200"><img
                        src="{{asset('frontend/'.App::getLocale().'/assets/images/hannah-morgan-ycVFts5Ma4s-unsplash.jpg')}}" alt="newsletter image"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="section-content-box" data-aos="fade-up" data-aos-duration="1000">
                                <!--=== Section Title  ===-->
                                <div class="section-title">
                                    <div class="sub-heading d-inline-flex align-items-center">
                                        <i class="flaticon-sparkler"></i>
                                        <span class="sub-title">Our Newsletter</span>
                                    </div>
                                    <h2>Subscribe <span>newsletter</span> <br> to & get Every day discount</h2>
                                </div>
                                 <form action="{{ route('newsletter.subscribe') }}" method="POST">
         @csrf
                                    <input type="email" class="form_control" placeholder="{{ __('home.write_email') }}"
                                        name="email" required>
                                    <button class="theme-btn style-one">{{ __('home.subscribe')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--====== End Newsletter Section ======-->
    </main>
    @endsection