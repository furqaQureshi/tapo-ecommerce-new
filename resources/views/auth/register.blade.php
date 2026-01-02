@extends('front.layouts.app')
@section('title')
    {{ __('lang.register') }}
@endsection
@section('content')
    <!-- Shop-categories-Section Start -->
    <section class="my-account-section section-padding fix pattern-bg">
        <div class="container">
            <div class="account-wrapper">
                <div class="row justify-content-center">
                    <div class="col-lg-6">

                        <div class="account-box">
                            <h3>{{ __('lang.create_new_account') }}</h3>
                            <h6>{{ __('lang.already_have_account') }} <a
                                    href="{{ route('login') }}"><span>{{ __('lang.login') }} Here</span></a></h6>
                            {{-- <div class="account-item">
                                <div class="google-image">
                                    <img src="{{ asset('front/assets') }}/img/google.png" alt="img">
                                </div>
                                <div class="facebook">
                                    <i class="fa-brands fa-facebook"></i>
                                </div>
                                <div class="apple">
                                    <i class="fa-brands fa-apple"></i>
                                </div>
                            </div> --}}
                            <div class="contact-form-item mb-4">
                                <form method="POST" action="{{ route('register') }}" id="contact-form2">
                                    @csrf
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                            <div class="form-clt">
                                                <input type="text" name="name"
                                                    class="@error('name') is-invalid @enderror" id="name20"
                                                    placeholder="{{ __('lang.your_name') }}" value="{{ old('name') }}"
                                                    required autocomplete="name" autofocus>
                                            </div>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-clt">
                                                <input type="text" name="last_name"
                                                    class="@error('last_name') is-invalid @enderror" id="last_name20"
                                                    placeholder="{{ __('lang.last_name') }}" value="{{ old('last_name') }}"
                                                    required autocomplete="last_name" autofocus>
                                            </div>
                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-clt">
                                                <input type="number" name="phone"
                                                    class="@error('phone') is-invalid @enderror" id="phone20"
                                                    placeholder="{{ __('lang.phone') }}" value="{{ old('phone') }}"
                                                    required autocomplete="phone" autofocus>
                                            </div>
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-clt">
                                                <input type="email" name="email"
                                                    class="@error('email') is-invalid @enderror" id="email20"
                                                    placeholder="{{ __('lang.reg_email') }}" value="{{ old('email') }}"
                                                    required autocomplete="email" autofocus>
                                            </div>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-clt">
                                                <input type="password" name="password" id="password_x"
                                                    placeholder="{{ __('lang.create_password') }}"
                                                    class="@error('password') is-invalid @enderror" required
                                                    autocomplete="new-password">
                                                <div class="icon toggle-password" data-target="#password_x">
                                                    <i class="far fa-eye-slash"></i>
                                                </div>
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 d-none">
                                            <div class="form-clt">
                                                <input type="password" name="password_confirmation" id="password3"
                                                    placeholder="{{ __('lang.Confirm_Password') }}"
                                                    class="@error('password') is-invalid @enderror"
                                                    autocomplete="new-password">
                                                <div class="icon toggle-password" data-target="#password3">
                                                    <i class="far fa-eye-slash"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="theme-btn header-btn w-100">
                                                {{ __('lang.create_account') }}
                                            </button>
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
