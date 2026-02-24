@extends('front.layouts.main_layout')

@section('content')
<main class="main-bg">
    @include('front.auth.forgot._banner', ['title' => __('home.reset_password')])

    <section class="contact-section login-form-back pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="contact-wrapper p-r z-1 back-all-form" data-aos="fade-right" data-aos-delay="10" data-aos-duration="1000">

                        <div class="text-center">
                            <h3 class="mb-3 mt-3">
                                <i class="flaticon-star-2 srarr"></i>
                                {{ __('home.reset_password') }}
                                <i class="flaticon-star-2 srarr"></i>
                            </h3>
                            <p class="mb-0">{{ __('home.enter_new_password') }}</p>
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

                        <form class="pesco-contact-form mt-3" action="{{ route('front.forgot.reset') }}" method="POST">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group" style="position: relative;">
                                        <input type="password"
                                               placeholder="{{ __('home.password') }}"
                                               class="form_control"
                                               name="password"
                                               id="password"
                                               required>
                                        <i class="far fa-eye" id="togglePassword"
                                           style="position:absolute; right:15px; top:50%; transform:translateY(-50%); cursor:pointer; color:#999;"></i>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group" style="position: relative;">
                                        <input type="password"
                                               placeholder="{{ __('home.password_confirmation') }}"
                                               class="form_control"
                                               name="password_confirmation"
                                               id="confirmPassword"
                                               required>
                                        <i class="far fa-eye" id="toggleConfirmPassword"
                                           style="position:absolute; right:15px; top:50%; transform:translateY(-50%); cursor:pointer; color:#999;"></i>
                                    </div>
                                </div>

                                <div class="col-lg-12 text-center">
                                    <div class="form_group">
                                        <button class="theme-btn style-one">{{ __('home.reset_password') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <script>
                            (function(){
                                const togglePassword = document.getElementById('togglePassword');
                                const password = document.getElementById('password');
                                const toggleConfirm = document.getElementById('toggleConfirmPassword');
                                const confirm = document.getElementById('confirmPassword');

                                if(togglePassword && password){
                                    togglePassword.addEventListener('click', function(){
                                        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                                        password.setAttribute('type', type);
                                        this.classList.toggle('fa-eye-slash');
                                    });
                                }

                                if(toggleConfirm && confirm){
                                    toggleConfirm.addEventListener('click', function(){
                                        const type = confirm.getAttribute('type') === 'password' ? 'text' : 'password';
                                        confirm.setAttribute('type', type);
                                        this.classList.toggle('fa-eye-slash');
                                    });
                                }
                            })();
                        </script>

                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
@endsection