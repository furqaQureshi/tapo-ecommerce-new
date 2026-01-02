{{-- @extends('admin.auth.layouts.app')

@section('page-title')

    Login

@endsection

@section('page-content')

    <div class="auth-page-content">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="text-center mt-sm-5 mb-4 text-white-50">

                        <div>

                            <a href="javascript::void(0);" class="d-inline-block auth-logo">

                                <img src="{{ URL('admin/assets') }}/images/logo-light.png" alt="" height="35">

                            </a>

                        </div>

                        <p class="mt-3 fs-15 fw-medium">Here is your dashboard login</p>

                    </div>

                </div>

            </div>

            <!-- end row -->



            <div class="row justify-content-center">

                <div class="col-md-8 col-lg-6 col-xl-5">

                    <div class="card mt-4 card-bg-fill">



                        <div class="card-body p-4">

                            <div class="text-center mt-2">

                                <h5 class="text-primary">Welcome Back !</h5>

                                <p class="text-muted">Sign in to continue to {{ config('app.name') }}.</p>

                            </div>

                            <div class="p-2 mt-4">

                                <form action="{{ route('admin.login.submit') }}" method="POST">

                                    @csrf

                                    <div class="mb-3">

                                        <label for="email" class="form-label">Email</label>

                                        <input type="text" name="email"

                                            class="form-control @error('email') is-invalid @enderror" id="email"

                                            placeholder="Enter email" value="{{ old('email') }}">

                                        @error('email')

                                            <span class="text-danger">{{ $message }}</span>

                                        @enderror

                                    </div>



                                    <div class="mb-3">

                                        <label class="form-label" for="password-input">Password</label>

                                        <div class="position-relative auth-pass-inputgroup mb-3">

                                            <input type="password" name="password"

                                                class="form-control pe-5 password-input @error('password') is-invalid @enderror"

                                                placeholder="Enter password" id="password-input">

                                            <button

                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none"

                                                type="button" id="password-addon"><i

                                                    class="ri-eye-fill align-middle"></i></button>

                                        </div>

                                        @error('password')

                                            <span class="text-danger">{{ $message }}</span>

                                        @enderror

                                    </div>



                                    <div class="form-check">

                                        <input class="form-check-input" type="checkbox" value=""

                                            id="auth-remember-check">

                                        <label class="form-check-label" for="auth-remember-check">Remember me</label>

                                    </div>



                                    <div class="mt-4">

                                        <button class="btn btn-danger w-100" type="submit">Sign In</button>

                                    </div>





                                </form>









                            </div>

                        </div>

                        <!-- end card body -->

                    </div>

                    <!-- end card -->



                </div>

            </div>

            <!-- end row -->

        </div>

        <!-- end container -->

    </div>

@endsection --}}


@extends('front.layouts.urwah_partials.app')
@section('content')

   <main>
                    <!--====== Start Page Banner ======-->
                    <section class="page-banner bg_cover p-r z-1" style="background-image: url(assets/images/home/hero/hero-bg-1.jpg);">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-10">
                                    <div class="page-content text-center">
                                        <h1>My Account</h1>
                                        <ul>
                                            <li><a href="#">Home</a></li>
                                            <li>/</li>
                                            <li>My Account</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!--====== End Page Banner ======-->
                    <!--====== Start Menu List Section ======-->
                    <section class="bistly-menu-list py-5 policy-pages primary-bgcolor-3">
                        <div class="container">
                            <div class="row justify-content-center py-5">
                                <div class="col-md-12">
                                    <div class="tac-auth-card row g-0">
                                        <!-- Form Section -->
                                        <div class="tac-form-section">
                                            <!-- Navigation Tabs -->
                                            <ul class="nav nav-tabs tac-nav-tabs" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link tac-nav-link active" id="tac-login-tab" data-bs-toggle="tab" data-bs-target="#tac-login" type="button" role="tab">
                                                        <i class="fas fa-sign-in-alt me-2"></i>Login
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link tac-nav-link" id="tac-register-tab" data-bs-toggle="tab" data-bs-target="#tac-register" type="button" role="tab">
                                                        <i class="fas fa-user-plus me-2"></i>Register
                                                    </button>
                                                </li>
                                            </ul>

                                            <div class="tab-content">
                                                <!-- Login Form -->
                                                <div class="tab-pane fade show active" id="tac-login" role="tabpanel">
                                                    <form action="{{ route('admin.login.submit') }}" method="POST" class="tac-login-form">
                                                        @csrf
                                                        <div class="tac-form-group">
                                                            <label class="tac-form-label">Email Address</label>
                                                            <input type="email" name="email" class="form-control tac-form-control" placeholder="Enter your email" required>
                                                        </div>

                                                        <div class="tac-form-group">
                                                            <label class="tac-form-label">Password</label>
                                                            <div class="tac-input-group">
                                                                <input type="password" class="form-control tac-form-control" id="tac-login-password" placeholder="Enter your password" name="password" required>
                                                                <i class="fas fa-eye tac-input-icon" onclick="togglePassword('tac-login-password')"></i>
                                                            </div>
                                                        </div>

                                                        <div class="tac-checkbox-wrapper">
                                                            <input type="checkbox" class="form-check-input tac-checkbox" id="tac-remember">
                                                            <label class="form-check-label" for="tac-remember">Remember me</label>
                                                        </div>

                                                        <button type="submit" class="theme-btn style-one w-100">
                                                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                                                        </button>

                                                        <a href="#" class="tac-forgot-link">Forgot your password?</a>
                                                    </form>

                                                    <div class="tac-divider">
                                                        <span>or continue with</span>
                                                    </div>

                                                    <div class="row g-2">
                                                        <div class="col-6">
                                                            <a href="{{ route('login.google') }}" class="tac-social-btn">
                                                                <i class="fab fa-google me-2 text-danger"></i>Google
                                                            </a>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="#" class="tac-social-btn">
                                                                <i class="fab fa-facebook me-2 text-primary"></i>Facebook
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Register Form -->
                                                <div class="tab-pane fade" id="tac-register" role="tabpanel">
                                                    <form class="tac-register-form" method="POST" action="{{ route('customerRegister') }}">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="tac-form-group">
                                                                    <label class="tac-form-label">First Name</label>
                                                                    <input type="text" class="form-control tac-form-control" name="first_name" placeholder="First name" required>
                                                                @error('first_name')
                                                                <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="tac-form-group">
                                                                    <label class="tac-form-label">Last Name</label>
                                                                    <input type="text" name="last_name" class="form-control tac-form-control" placeholder="Last name" required>
                                                                    @error('last_name')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="tac-form-group">
                                                            <label class="tac-form-label">Email Address</label>
                                                            <input type="email" name="email" class="form-control tac-form-control" placeholder="Enter your email" required>
                                                            @error('email')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>

                                                        <div class="tac-form-group">
                                                            <label class="tac-form-label">Phone Number</label>
                                                            <input type="tel" name="phone_number" class="form-control tac-form-control" placeholder="Enter your phone number" required>
                                                            @error('phone_number')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>

                                                        <div class="tac-form-group">
                                                            <label class="tac-form-label">Password</label>
                                                            <div class="tac-input-group">
                                                                <input type="password" name="password" class="form-control tac-form-control" id="tac-register-password" placeholder="Create a password" required>
                                                                @error('password')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                <i class="fas fa-eye tac-input-icon"></i>
                                                            </div>
                                                        </div>

                                                        <div class="tac-form-group">
                                                            <label class="tac-form-label">Confirm Password</label>
                                                            <div class="tac-input-group">
                                                                <input type="password" name="confirm_password" class="form-control tac-form-control" id="tac-confirm-password" placeholder="Confirm your password" required>
                                                                @error('confirm_password')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                <i class="fas fa-eye tac-input-icon"></i>
                                                            </div>
                                                        </div>

                                                        <div class="tac-checkbox-wrapper">
                                                            <input type="checkbox" class="form-check-input tac-checkbox" id="tac-terms" required>
                                                            <label class="form-check-label" for="tac-terms">I agree to the <a href="#" class="text-decoration-none">Terms & Conditions</a></label>
                                                        </div>

                                                        <button type="submit" class="theme-btn style-one w-100">
                                                            <i class="fas fa-user-plus me-2"></i>Create Account
                                                        </button>
                                                    </form>

                                                    <div class="tac-divider">
                                                        <span>or sign up with</span>
                                                    </div>

                                                    <div class="row g-2">
                                                        <div class="col-6">
                                                            <a href="{{ route('login.google') }}" class="tac-social-btn">
                                                                <i class="fab fa-google me-2 text-danger"></i>Google
                                                            </a>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="#" class="tac-social-btn">
                                                                <i class="fab fa-facebook me-2 text-primary"></i>Facebook
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!--====== End Menu List Section ======-->
                </main>

@stop
