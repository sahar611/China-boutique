@extends('front.layouts.main_layout')

@section('content')
<main class="main-bg">
    <section class="page-banner dir-rtl">
        <div class="page-banner-wrapper p-r z-1">
            <svg class="lineanm" viewBox="0 0 1920 347" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="line"
                    d="M-39 345.187C70 308.353 397.628 293.477 436 145.186C490 -63.5 572 -57.8156 688 255.186C757.071 441.559 989.5 -121.315 1389 98.6856C1708.6 274.686 1940.33 156.519 1964.5 98.6856"
                    stroke="white" stroke-width="3" stroke-dasharray="2 2" />
            </svg>
            <div class="page-image"><img src="{{asset('frontend/'.App::getLocale().'/assets/images/bg/page-img-1.png')}}" alt="image"></div>

            <svg class="page-svg" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.1742 33.0065C14.029 35.2507 7.5486 39.0636 0 40.7339V86H1937V64.9942C..."
                    fill="#FFFAF3" />
            </svg>

            <div class="shape shape-three"><span><img src="{{asset('frontend/'.App::getLocale().'/assets/images/shape/curved-arrow.png')}}" alt=""></span></div>
            <div class="shape shape-four"><span><img src="{{asset('frontend/'.App::getLocale().'/assets/images/shape/stars.png')}}" alt=""></span></div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-banner-content">
                            <h1>{{ __('home.forget_password') }}</h1>
                            <ul class="breadcrumb-link">
                                <li><a href="{{ route('home') }}">{{ __('home.home') }}</a></li>
                                <li><i class="far fa-long-arrow-right"></i></li>
                                <li class="active">{{ __('home.forget_password') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="contact-section login-form-back pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="contact-wrapper p-r z-1 back-all-form" data-aos="fade-right" data-aos-delay="10" data-aos-duration="1000">

                        <div class="text-center">
                            <h3 class="mb-3 mt-3">
                                <i class="flaticon-star-2 srarr"></i>
                                {{ __('home.forget_password') }}
                                <i class="flaticon-star-2 srarr"></i>
                            </h3>
                            <p class="mb-0">{{ __('home.enter_email_to_receive_otp') }}</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success mt-3">{{ session('success') }}</div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger mt-3">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="pesco-contact-form mt-3" action="{{ route('front.forgot.send.otp') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="email"
                                               placeholder="{{ __('home.email') }}"
                                               class="form_control"
                                               name="email"
                                               value="{{ old('email') }}"
                                               required>
                                    </div>
                                </div>

                                <div class="col-lg-12 text-center">
                                    <div class="form_group">
                                        <button class="theme-btn style-one">{{ __('home.send_otp') }}</button>
                                    </div>
                                </div>

                                <div class="col-lg-12 text-center mt-3">
                                    <a href="{{ route('login') }}">{{ __('home.back_to_login') }}</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
@endsection