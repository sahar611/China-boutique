@extends('front.layouts.main_layout')

@section('content')
<main class="main-bg">
    @include('front.auth.forgot._banner', ['title' => __('home.verify_otp')])

    <section class="contact-section login-form-back pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="contact-wrapper p-r z-1 back-all-form" data-aos="fade-right" data-aos-delay="10" data-aos-duration="1000">

                        <div class="text-center">
                            <h3 class="mb-3 mt-3">
                                <i class="flaticon-star-2 srarr"></i>
                                {{ __('home.verify_otp') }}
                                <i class="flaticon-star-2 srarr"></i>
                            </h3>
                            <p class="mb-0">{{ __('home.otp_sent_to_email') }}: <strong>{{ $email }}</strong></p>
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

                        <form class="pesco-contact-form mt-3" action="{{ route('front.forgot.verify.otp') }}" method="POST">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text"
                                               inputmode="numeric"
                                               maxlength="6"
                                               placeholder="{{ __('home.enter_otp') }}"
                                               class="form_control"
                                               name="otp"
                                               value="{{ old('otp') }}"
                                               required>
                                    </div>
                                </div>

                                <div class="col-lg-12 text-center">
                                    <div class="form_group">
                                        <button class="theme-btn style-one">{{ __('home.verify') }}</button>
                                    </div>
                                </div>

                                <div class="col-lg-12 text-center mt-3">
                                    <form action="{{ route('front.forgot.send.otp') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ $email }}">
                                        <button type="submit" class="btn btn-link p-0">{{ __('home.resend_otp') }}</button>
                                    </form>
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