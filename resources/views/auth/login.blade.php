@extends('front.layouts.app')
@section('title')
    {{ __('lang.login') }}
@endsection
@section('content')
    <!-- Shop-categories-Section Start -->
    <section class="my-account-section section-padding fix pattern-bg">
        <div class="container">
            <div class="account-wrapper">
                <div class="row justify-content-center">
                    <div class="col-lg-6">

                        <div class="account-box">
                            <h3>{{ __('lang.login_in') }}</h3>

                            {{-- <div class="account-item">
                                <div class="google-image">
                                    <a href="{{ route('redirectToGoogle') }}">
                                        <img src="{{ asset('front/assets') }}/img/google.png" alt="img">
                                    </a>
                                </div>
                                <div class="facebook">
                                    <i class="fa-brands fa-facebook"></i>
                                </div>
                                <div class="apple">
                                    <i class="fa-brands fa-apple"></i>
                                </div>
                            </div> --}}


                            <div class="contact-form-item">
                                <form method="POST" action="{{ route('login') }}" id="contact-form2" autocomplete="off">
                                    @csrf
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                            <div class="form-clt">
                                                <input type="email" name="email"
                                                    class="@error('email') is-invalid @enderror" id="email20"
                                                    placeholder="{{ __('lang.your_email') }}" value="{{ old('email') }}"
                                                    required autocomplete="off" autofocus>
                                            </div>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-clt">
                                                <input type="password" name="password" id="password_log"
                                                    placeholder="{{ __('lang.password') }}"
                                                    class="@error('password') is-invalid @enderror" required
                                                    autocomplete="off">
                                                <div class="icon toggle-password" data-target="#password_log">
                                                    <i class="far fa-eye-slash"></i>
                                                </div>
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="from-cheak-items">
                                                <div class="form-check d-flex gap-2 from-customradio">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                        id="flexRadioDefault2" name="remember"
                                                        {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        {{ __('lang.remember_me') }}
                                                    </label>
                                                </div>
                                                @if (Route::has('password.request'))
                                                    <a
                                                        href="{{ route('password.request') }}"><span>{{ __('lang.forgot_password') }}</span></a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="theme-btn header-btn w-100">
                                                Log In
                                            </button>

                                             <h6 class="mt-1">{{ __('lang.login_new_user') }} <a
                                    href="{{ route('register') }}"><span>{{ __('lang.login_free_account_here') }}</span></a>
                            </h6>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
