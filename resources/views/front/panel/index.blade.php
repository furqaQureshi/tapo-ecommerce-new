@extends('front.layouts.panel.app')
@section('title')
    {{ __('lang.my_account') }}
@endsection
@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('style')
    <style>
        .reward-points-container {
            padding: 0;
        }

        .reward-header {
            background: var(--gradient-primary);
            color: #350c0c;
            padding: 2rem;
            border-radius: 15px;
            position: relative;
            overflow: hidden;
        }

        .reward-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {

            0%,
            100% {
                transform: translateX(-10px) translateY(-10px);
            }

            50% {
                transform: translateX(10px) translateY(10px);
            }
        }

        .reward-header h2 {
            margin: 0;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 2;
        }

        .reward-header p {
            position: relative;
            z-index: 2;
        }

        .current-points-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(228, 144, 161, 0.15);
            margin-bottom: 2rem;
            border: 2px solid var(--primary-light);
        }

        .points-display-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .coin-icon-large {
            width: 80px;
            height: 80px;
            background: var(--coin-gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px var(--coin-shadow);
            position: relative;
            animation: coinFloat 3s ease-in-out infinite;
        }

        .swal2-confirm-1-f {
            cursor: pointer !important;
            border: 2px solid var(--theme) !important;
            background-color: var(--theme) !important;
            color: var(--theme-4) !important;
            font-size: 16px !important;
            border-radius: 24px !important;
            padding: 20px 50px !important;
            font-weight: 500 !important;
        }

        .swal2-cancel-1-f {
            cursor: pointer !important;
            border: 2px solid var(--theme) !important;
            background-color: transparent !important;
            color: var(--theme) !important;
            font-size: 16px !important;
            border-radius: 24px !important;
            padding: 20px 30px !important;
            font-weight: 500 !important;
        }

        .swal2-actions {
            gap: 12px !important;
        }


        @keyframes coinFloat {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .coin-icon-large::before {
            content: '';
            position: absolute;
            inset: 5px;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.8), transparent 50%);
        }

        .coin-icon-large i {
            font-size: 2rem;
            color: #b8860b;
            z-index: 2;
        }

        .points-number {
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary-color);
            margin: 0;
            text-shadow: 2px 2px 4px rgba(228, 144, 161, 0.2);
        }

        .points-label {
            color: #666;
            font-size: 1.1rem;
            margin-top: 0.5rem;
        }

        .stat-card {
            padding: 1rem;
            background: rgba(228, 144, 161, 0.05);
            border-radius: 10px;
            margin: 0.25rem;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .earning-info-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .earning-info-card h4 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .earning-method {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(228, 144, 161, 0.05);
            border-radius: 10px;
            border-left: 4px solid var(--primary-color);
        }

        .earning-icon {
            width: 50px;
            height: 50px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f58c9d;
            font-size: 1.2rem;
        }

        .earning-method h6 {
            margin: 0;
            color: #333;
            font-weight: 600;
        }

        .earning-method small {
            color: #666;
            margin-top: 0.25rem;
        }

        .points-history-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .history-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--primary-light);
        }

        .history-header h4 {
            color: var(--primary-color);
            margin: 0;
            font-weight: 600;
        }

        .points-table {
            margin-top: 1rem;
        }

        .points-table thead th {
            background-color: var(--primary-color);
            border: none;
            font-weight: 600;
            padding: 1rem 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
        }

        .points-table tbody td {
            padding: 0.45rem;
            vertical-align: middle;
            border-bottom: 1px solid #eee;
            font-size: 13px;
        }

        .points-table tbody tr:hover {
            background-color: rgba(228, 144, 161, 0.05);
        }

        .points-badge {
            background: var(--gradient-primary);
            color: #008959;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .order-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .order-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .points-display-section {
                flex-direction: column;
                text-align: center;
            }

            .points-number {
                font-size: 2.5rem;
            }

            .current-points-card {
                padding: 1.5rem;
            }

            .earning-info-card {
                padding: 1.5rem;
            }

            .points-history-card {
                padding: 1.5rem;
            }
        }

        .nav-link:hover{
            position: relative
        }
    </style>
@endsection
@section('content')
    <!-- My-account-Section Start -->
    <section class="my-account-section section-padding fix pattern-bg">
        <div class="container">
            <div class="my-account-wrapper">
                <div class="row g-4 myacc-row">
                    <div class="col-lg-4 myacc-col-1">
                        <div class="wrap-sidebar-account">
                            <div class="sidebar-account">
                                <div class="account-avatar">
                                    <div class="image">
                                        <img src="{{ auth()->user()->avatar ? URL(auth()->user()->avatar) : URL('front/assets//img/account-avatar.svg') }}"
                                            alt="{{ auth()->user()->name }} {{ auth()->user()->last_name }}">
                                    </div>
                                    <h6 class="mb_4">{{ !empty(auth()->user()->first_name) ? auth()->user()->first_name." ".auth()->user()->last_name : auth()->user()->name }}</h6>
                                    <div class="body-text-1">{{ auth()->user()->email }}</div>
                                    <div class="col-md-12 text-center">
                                        @if (auth()->user()->subscription_status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @elseif (auth()->user()->subscription_status == 2)
                                            <span class="badge bg-warning">Pending Payment</span>
                                        @elseif (auth()->user()->subscription_status == 3)
                                            <span class="badge bg-danger">Cancelled Subscription</span>
                                        @elseif (auth()->user()->subscription_status == 4)
                                            <span class="badge bg-info">Failed Payment</span>
                                        @endif
                                        <div class="col-md-12 mt-2">
                                            @if (auth()->user()->subscription_status == 1)
                                                Plan: ({{ $myPlan->title ?? '' }})
                                            @endif
                                        </div>

                                        @if (
                                            (isset(Auth::user()->subscription_status) && Auth::user()->subscription_status == 2) ||
                                                Auth::user()->subscription_status == 4)
                                            <a href="{{ route('choose-products') }}" id="resubscribe-subscription"
                                                class="theme-btn">
                                                Pay Now
                                            </a>
                                        @elseif (isset(Auth::user()->subscription_status) && Auth::user()->subscription_status == 3)
                                            <a href="{{ route('choose-products') }}" id="resubscribe-subscription"
                                                class="theme-btn">
                                                {{ __('lang.resubscribe_now') }}
                                            </a>
                                        @endif

                                            
                                        @if (isset($lastDaysExpireSubription) && !is_null($lastDaysExpireSubription) && auth()->user()->subscription_status != 1)
                                            <a href="{{ route('choose-products') }}" id="resubscribe-subscription"
                                                class="theme-btn mt-3">
                                                Chosee Now
                                            </a>
                                        @endif

                                        {{-- @if (auth()->user()->subscription_status != 1)
                                       <div class="col-md-12 mt-2">
                                            <a href="{{route('choose-products')}}" class="hs-btn hs-btn-primary">Pay Now</a>
                                       </div>
                                       @endif --}}
                                    </div>
                                </div>
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="#order" data-bs-toggle="tab" class="nav-link active">
                                            <img src="{{ asset('front/assets/img/account/4.svg') }}" alt="img" />
                                            {{ __('lang.your_orders') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#Account" data-bs-toggle="tab" class="nav-link">
                                            <img src="{{ asset('front/assets/img/account/1.svg') }}" alt="img" />
                                            {{ __('lang.account_details') }}
                                        </a>
                                    </li>
                                    @if (auth()->user()->subscription_status == 1)
                                        <li class="nav-item">
                                            <a href="#mother_form_details" data-bs-toggle="tab" class="nav-link">
                                                <img src="{{ asset('front/assets/img/account/2.svg') }}" alt="img" />
                                                {{ __('lang.mother_form_details') }}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('onboarding.show') }}" class="nav-link">
                                                <img src="{{ asset('front/assets/img/account/3.svg') }}" alt="img" />
                                                {{ __('lang.complete_profile') }}
                                            </a>
                                        </li>
                                    @endif

                                    <li class="nav-item">
                                        <a href="#reward-points" data-bs-toggle="tab" class="nav-link">
                                            <img src="{{ asset('front/assets/img/account/5.svg') }}" alt="img" />
                                            {{ __('lang.reward_points') }}
                                        </a>
                                    </li>
                                    <li class="nav-item d-none">
                                        <a href="#wallet" data-bs-toggle="tab" class="nav-link">
                                            <i class="fa-solid fa-wallet"></i>
                                            {{ __('lang.mywallet') }} &nbsp; &nbsp;
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void();" class="nav-link"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <img src="{{ asset('front/assets/img/account/6.svg') }}" alt="img" />
                                            {{ __('lang.Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 myacc-col-2">
                        <div class="tab-content">
                            <div id="Account" class="tab-pane fade">
                                <div class="account-details">
                                    <div class="account-info">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3>{{ __('lang.information') }}</h3>


                                        </div>
                                        <form action="{{ route('user.updateProfile', auth()->user()->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="form-clt">
                                                        <input type="file" name="avatar" id="avatar"
                                                            class="@error('avatar') is-invalid @enderror">
                                                    </div>
                                                    @if (auth()->user()->avatar)
                                                        <div class="mt-2">
                                                            <a href="{{ asset(auth()->user()->avatar) }}"
                                                                class="text-danger"
                                                                target="_blank">{{ __('lang.Uploaded_Avatar') }} <i
                                                                    class="fa fa-external-link"
                                                                    aria-hidden="true"></i></a>
                                                        </div>
                                                    @endif
                                                    @error('avatar')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-clt">
                                                        <input type="text" name="name" id="name"
                                                            placeholder="{{ __('lang.full_name') }}"
                                                            value="{{ old('name', !empty(auth()->user()->first_name) ? auth()->user()->first_name : auth()->user()->name) }}"
                                                            class="@error('name') is-invalid @enderror">
                                                    </div>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-clt">
                                                        <input type="text" name="last_name" id="name2"
                                                            placeholder="{{ __('lang.last_name') }}"
                                                            value="{{ old('last_name', auth()->user()->last_name) }}"
                                                            class="@error('last_name') is-invalid @enderror">
                                                    </div>
                                                    @error('last_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-clt">
                                                        <input type="email" name="email" id="email"
                                                            placeholder="{{ __('lang.email') }}"
                                                            value="{{ old('email', auth()->user()->email) }}"
                                                            class="@error('email') is-invalid @enderror">
                                                    </div>
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-clt">
                                                        <input type="text" name="phone" id="number"
                                                            placeholder="{{ __('lang.Phone_no') }}"
                                                            value="{{ old('phone', auth()->user()->phone) }}"
                                                            class="@error('phone') is-invalid @enderror">
                                                    </div>
                                                    @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                  <div class="col-lg-6">
                                                    <div class="form-clt">
                                                        <div class="form">
                                                            <select name="towncity" id="towncity"
                                                                class="form-control js-example-basic-single">
                                                                <option disabled selected>State
                                                                </option>
                                                                {{-- 
                                                                @foreach ($cities as $city)
                                                                    <option value="{{ $city->name }}"
                                                                        @if (auth()->check() && $city->name == auth()->user()->towncity) selected @endif>
                                                                        {{ $city->name }} ({{ $city->state }})
                                                                    </option>
                                                                @endforeach
                                                                --}}
                                                            </select>
                                                        </div>
                                                    </div>
                                                <div class="col-lg-6">
                                                    <div class="form-clt">
                                                        <div class="form">
                                                            <select name="towncity" id="towncity"
                                                                class="form-control js-example-basic-single">
                                                                <option disabled selected>{{ __('lang.select_a_city') }}
                                                                </option>
                                                                {{-- 
                                                                @foreach ($cities as $city)
                                                                    <option value="{{ $city->name }}"
                                                                        @if (auth()->check() && $city->name == auth()->user()->towncity) selected @endif>
                                                                        {{ $city->name }} ({{ $city->state }})
                                                                    </option>
                                                                @endforeach
                                                                --}}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @error('towncity')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-clt">
                                                        <div class="form">
                                                            <input type="text" name="address2"
                                                                placeholder="Postal Code"
                                                                value="{{ old('address2', auth()->user()->address2) }}"
                                                                class="@error('address2') is-invalid @enderror">
                                                        </div>
                                                    </div>
                                                    @error('address2')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-clt">
                                                        <div class="form">
                                                            <textarea name="address" rows="4" class="form-control" style="resize:none"
                                                                placeholder="{{ __('lang.address_line_1') }}">{{ old('address', auth()->user()->address) }}</textarea>
                                                        </div>
                                                    </div>
                                                    @error('address')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <button type="submit"
                                                            class="theme-btn">{{ __('lang.update') }}</button>
                                                    </div>


                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="account-password mt-5">
                                        <div class="account-info">
                                            <h3>{{ __('lang.Change_Password') }}</h3>
                                            <form action="{{ route('change.password') }}" method="POST">
                                                @csrf
                                                <div class="row g-4">
                                                    <div class="col-lg-12">
                                                        <div class="form-clt">
                                                            <input id="password2" type="password" name="old_password"
                                                                placeholder="{{ __('lang.password') }}"
                                                                class="@error('old_password') is-invalid @enderror"
                                                                required>
                                                            <div class="icon toggle-password" data-target="#password2">
                                                                <i class="far fa-eye-slash"></i>
                                                            </div>
                                                        </div>
                                                        @error('old_password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-clt">
                                                            <input id="password3" name="new_password" type="password"
                                                                placeholder="{{ __('lang.create_password') }}"
                                                                class="@error('new_password') is-invalid @enderror"
                                                                required>
                                                            <div class="icon toggle-password" data-target="#password3">
                                                                <i class="far fa-eye-slash"></i>
                                                            </div>
                                                        </div>
                                                        @error('new_password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-clt">
                                                            <input id="password4" type="password"
                                                                placeholder="{{ __('lang.Confirm_Password') }}"
                                                                name="new_password_confirmation"
                                                                class="@error('new_password_confirmation') is-invalid @enderror"
                                                                required>
                                                            <div class="icon toggle-password" data-target="#password4">
                                                                <i class="far fa-eye-slash"></i>
                                                            </div>
                                                        </div>
                                                        @error('new_password_confirmation')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="text-center">
                                                            <button type="submit"
                                                                class="theme-btn">{{ __('lang.update') }}</button><br><br><br>


                                                            {{-- @if (isset(Auth::user()->subscription_status) && Auth::user()->subscription_status == 1)
                                                <button id="cancel-subscription" class="theme-btn">
                                                    {{ __('lang.cancel_subscription') }}
                                                </button>
                                            @elseif (isset(Auth::user()->subscription_status) && Auth::user()->subscription_status == 2)
                                                <a href="{{ route('choose-products') }}" id="resubscribe-subscription" class="btn btn-primary">
                                                    {{ __('lang.resubscribe_now') }}
                                                </a>
                                            @endif --}}
                                                            @if (isset(Auth::user()->subscription_status) && Auth::user()->subscription_status == 1)
                                                                <button id="cancel-subscription" class="theme-btn">
                                                                    {{ __('lang.cancel_subscription') }}
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="mother_form_details" class="tab-pane fade show">
                                <div class="account-details">
                                    <div class="account-info">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h3 class="mb-0">{{ __('lang.mother_form_details') }}</h3>
                                        </div>
                                        <form action="{{ route('subscriber-form-update', auth()->user()->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row g-4">
                                                <!-- Is First Time Mother -->
                                                <div class="col-lg-6">
                                                    <div class="form-clt">
                                                        <label
                                                            for="is_first_time_mother">{{ __('lang.is_first_time_mother') }}</label>
                                                        <div class="form">
                                                            <select name="is_first_time_mother" id="is_first_time_mother"
                                                                class="form-control">
                                                                <option disabled selected>{{ __('lang.select_option') }}
                                                                </option>
                                                                <option value="1"
                                                                    @if (auth()->check() && optional(auth()->user()->subscription_detail)->is_first_time_mother == 1) selected @endif>
                                                                    {{ __('lang.yes') }}
                                                                </option>

                                                                <option value="0"
                                                                    @if (auth()->check() && optional(auth()->user()->subscription_detail)->is_first_time_mother == 0) selected @endif>
                                                                    {{ __('lang.no') }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @error('is_first_time_mother')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <!-- Is Currently Pregnant -->
                                                <div class="col-lg-6">
                                                    <div class="form-clt">
                                                        <label
                                                            for="is_currently_pregnant">{{ __('lang.is_currently_pregnant') }}</label>
                                                        <div class="form">
                                                            <select name="is_currently_pregnant"
                                                                id="is_currently_pregnant" class="form-control">
                                                                <option disabled selected>{{ __('lang.select_option') }}
                                                                </option>
                                                                <option value="1"
                                                                    @if (auth()->check() && optional(auth()->user()->subscription_detail)->is_currently_pregnant == 1) selected @endif>
                                                                    {{ __('lang.yes') }}
                                                                </option>

                                                                <option value="0"
                                                                    @if (auth()->check() && optional(auth()->user()->subscription_detail)->is_currently_pregnant == 0) selected @endif>
                                                                    {{ __('lang.no') }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @error('is_currently_pregnant')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-clt">
                                                        <label for="child_dobs">{{ __('lang.child_dobs') }}</label>
                                                        <div id="child_dobs_container">
                                                            @php
                                                                // Safely fetch child DOBs
                                                                $childDobs = old(
                                                                    'child_dobs',
                                                                    auth()->user()->subscription_detail?->child_dobs
                                                                        ? json_decode(
                                                                            auth()->user()->subscription_detail
                                                                                ?->child_dobs,
                                                                            true,
                                                                        )
                                                                        : [],
                                                                );
                                                                $childDobs = is_array($childDobs) ? $childDobs : [];
                                                            @endphp

                                                            @forelse($childDobs as $index => $dob)
                                                                <div class="input-group mb-2">
                                                                    <input type="date" name="child_dobs[]"
                                                                        class="form-control @error('child_dobs.' . $index) is-invalid @enderror"
                                                                        value="{{ old('child_dobs.' . $index, $dob) }}">
                                                                    <button type="button"
                                                                        class="btn btn-danger remove-dob">Remove</button>
                                                                </div>
                                                                @error('child_dobs.' . $index)
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            @empty
                                                                <!-- Default empty field if no DOBs exist -->
                                                                <div class="input-group mb-2">
                                                                    <input type="date" name="child_dobs[]"
                                                                        class="form-control @error('child_dobs.0') is-invalid @enderror"
                                                                        value="{{ old('child_dobs.0') }}">
                                                                    <button type="button"
                                                                        class="btn btn-danger remove-dob"
                                                                        style="display: none;">Remove</button>
                                                                </div>
                                                                @error('child_dobs.0')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            @endforelse
                                                        </div>

                                                        <button type="button" class="btn btn-secondary mt-2"
                                                            onclick="addChildDob()">Add Another Child DOB</button>
                                                    </div>
                                                </div>
                                                <!-- Date of Birth -->
                                                <div class="col-lg-6">
                                                    <div class="form-clt">
                                                        <label for="date_of_birth">{{ __('lang.date_of_birth') }}</label>
                                                        <input type="date" name="date_of_birth" id="date_of_birth"
                                                            placeholder="{{ __('lang.date_of_birth') }}"
                                                            value="{{ old('date_of_birth', auth()->user()->subscription_detail->date_of_birth ?? '') }}"
                                                            class="form-control @error('date_of_birth') is-invalid @enderror">
                                                    </div>
                                                    @error('date_of_birth')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <!-- Race -->
                                                <div class="col-lg-6">
                                                    <div class="form-clt">
                                                        <label for="race">{{ __('lang.race') }}</label>
                                                        <div class="form">
                                                            <select name="race" id="race" class="form-control">
                                                                <option value="" disabled selected>
                                                                    {{ __('lang.select_race') }}</option>

                                                                <option value="Malay"
                                                                    @if (auth()->check() && auth()->user()->subscription_detail?->race === 'Malay') selected @endif>
                                                                    Malay
                                                                </option>
                                                                <option value="Chinese"
                                                                    @if (auth()->check() && auth()->user()->subscription_detail?->race === 'Chinese') selected @endif>
                                                                    Chinese</option>
                                                                <option value="Indian"
                                                                    @if (auth()->check() && auth()->user()->subscription_detail?->race === 'Indian') selected @endif>
                                                                    Indian</option>
                                                                <option value="Iban"
                                                                    @if (auth()->check() && auth()->user()->subscription_detail?->race === 'Iban') selected @endif>Iban
                                                                </option>
                                                                <option value="Kadazan"
                                                                    @if (auth()->check() && auth()->user()->subscription_detail?->race === 'Kadazan') selected @endif>
                                                                    Kadazan</option>
                                                                <option value="Bidayuh"
                                                                    @if (auth()->check() && auth()->user()->subscription_detail?->race === 'Bidayuh') selected @endif>
                                                                    Bidayuh</option>
                                                                <option value="Orang Asli"
                                                                    @if (auth()->check() && auth()->user()->subscription_detail?->race === 'Orang Asli') selected @endif>
                                                                    Orang Asli</option>
                                                                <option value="Others"
                                                                    @if (auth()->check() && auth()->user()->subscription_detail?->race === 'Others') selected @endif>
                                                                    Others</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @error('race')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <!-- Expected Due Date -->
                                                <div class="col-lg-6">
                                                    <div class="form-clt">
                                                        <label
                                                            for="expected_due_date">{{ __('lang.expected_due_date') }}</label>
                                                        <input type="date" name="expected_due_date"
                                                            id="expected_due_date"
                                                            placeholder="{{ __('lang.expected_due_date') }}"
                                                            value="{{ old('expected_due_date', auth()->user()->subscription_detail->expected_due_date ?? '') }}"
                                                            class="form-control @error('expected_due_date') is-invalid @enderror">
                                                    </div>
                                                    @error('expected_due_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <!-- Number of Children -->
                                                <div class="col-lg-6">
                                                    <div class="form-clt">
                                                        <label
                                                            for="number_of_children">{{ __('lang.number_of_children') }}</label>
                                                        <input type="number" name="number_of_children"
                                                            id="number_of_children"
                                                            placeholder="{{ __('lang.number_of_children') }}"
                                                            value="{{ old('number_of_children', auth()->user()->subscription_detail->number_of_children ?? '') }}"
                                                            class="form-control @error('number_of_children') is-invalid @enderror">
                                                    </div>
                                                    @error('number_of_children')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <!-- Submit Button -->
                                                <div class="col-lg-12">
                                                    <div class="text-end">
                                                        <button type="submit"
                                                            class="custom-rdxbtnr">{{ __('lang.update') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="account-info">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h3 class="mb-0">{{ __('lang.onboarding') }}</h3>
                                        </div>
                                        <form action="{{ route('onboarding.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row g-4">
                                                <!-- What best describes you at the moment -->
                                                {{-- <div class="col-lg-12">
                                                    <div class="form-clt">
                                                        <label
                                                            for="descriptions">{{ __('lang.What_best_describes_you_at_the_moment') }}</label>
                                                        @php
                                                            // Get old values first (if validation failed)
                                                            $selectedDescriptions = old('descriptions') ?? null;

                                                            // If not coming from old(), try pulling from user->onboarding safely
                                                            if (is_null($selectedDescriptions)) {
                                                                $descriptions =
                                                                    auth()->user()->onboarding?->descriptions ?? null;
                                                                $selectedDescriptions =
                                                                    is_string($descriptions) && !empty($descriptions)
                                                                        ? json_decode(implode(',', $descriptions), true)
                                                                        : $descriptions ?? [];
                                                            }

                                                            // Ensure array
                                                            $selectedDescriptions = is_array($selectedDescriptions)
                                                                ? $selectedDescriptions
                                                                : [];

                                                            // Available options
                                                            $options = [
                                                                "I'm trying to conceive",
                                                                'I have indigestion problem',
                                                                'My children has indigestion problem',
                                                                'I have oily facial skin',
                                                                'I have mixed facial skin',
                                                                'I have sensitive facial skin',
                                                                'I have stretch marks',
                                                                'I have caesarean scar',
                                                                'My child has food allergy',
                                                                "I'm looking for educational toys",
                                                                'My child has eczema',
                                                                "I'm losing hair",
                                                                'I have dry hair',
                                                            ];
                                                        @endphp

                                                        <select name="descriptions[]" id="descriptions"
                                                            class="form-control select2" multiple>
                                                            @foreach ($options as $option)
                                                                <option value="{{ strtolower($option) }}"
                                                                    {{ in_array(strtolower($option), $selectedDescriptions) ? 'selected' : '' }}>
                                                                    {{ $option }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    @error('descriptions')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div> --}}


                                                <!-- What would you prefer -->
                                                {{-- <div class="col-lg-12">
                                                    <div class="form-clt">
                                                        <label
                                                            for="preferences">{{ __('lang.what_would_you_prefer') }}</label>
                                                        @php
                                                            // Get old input if validation failed
                                                            $selectedPreferences = old('preferences');

                                                            // Otherwise load from onboarding, but safely
                                                            if (is_null($selectedPreferences)) {
                                                                $selectedPreferences = auth()->user()->onboarding
                                                                    ?->preferences
                                                                    ? json_decode(
                                                                        auth()->user()->onboarding?->preferences,
                                                                        true,
                                                                    )
                                                                    : [];
                                                            }

                                                            // Ensure it's always an array
                                                        $selectedPreferences = is_array($selectedPreferences)
                                                            ? $selectedPreferences
                                                            : [];

                                                        // Available preference options
                                                        $prefOptions = [
                                                            'Lotion',
                                                            'Shower Products',
                                                            'Toys',
                                                            'Baby Food',
                                                            'Story Books',
                                                            'Diapers',
                                                            'Stretchmark Products',
                                                            'Facial Skincare',
                                                            'Anti-hairloss Shampoo',
                                                            ];
                                                        @endphp

                                                        <select name="preferences[]" id="preferences"
                                                            class="form-control select2" multiple>
                                                            @foreach ($prefOptions as $pref)
                                                                <option value="{{ strtolower($pref) }}"
                                                                    {{ in_array(strtolower($pref), $selectedPreferences) ? 'selected' : '' }}>
                                                                    {{ $pref }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    @error('preferences')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div> --}}


                                                <!-- Submit Button -->
                                                <div class="col-lg-12">
                                                    <div class="text-end">
                                                        <button type="submit"
                                                            class="custom-rdxbtnr">{{ __('lang.update') }}</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="order" class="tab-pane fade show active">
                                <div class="transaction-history">
                                    <h3>{{ __('lang.Orders') }}</h3>



                                    <div class="table-responsive">
                                        <table class="table transaction-table" id="orderTable" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-left">Date</th>
                                                    <th class="text-center">{{ __('lang.Order_ID') }}</th>
                                                    <th class="text-center">{{ __('lang.Amount') }}</th>
                                                    <th class="text-center">{{ __('lang.status') }}</th>
                                                    <th class="text-right">{{ __('lang.Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- 
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>{{ $order->created_at }}</td>
                                                        <td><a
                                                                href="{{ route('user.order.details', ['id' => $order->id]) }}">{{ $order->order_number }}</a>
                                                        </td>
                                                        <td>RM {{ $order->total_amount }}</td>
                                                        <td>{{ $order->status }}</td>
                                                        <td class="text-right">
                                                            <a href="{{ route('user.order.invoice', $order->id) }}"
                                                                class="action_btn" title="Generate Invoice"><i
                                                                    class="fas fa-file-invoice"></i></a>
                                                            @if ($order->status == 'failed')
                                                                @if ($order->subscription_link)
                                                                    <a href="{{ $order->subscription_link }}"
                                                                        class="action_btn" title="Pay Now"> <i
                                                                            class="fa fa-credit-card"></i></a>
                                                                @else
                                                                    <a href="#1"
                                                                        data-order="{{ $order->razorpay_order_id }}"
                                                                        data-customer="{{ $order->razorpay_customer_id ?? auth()->user()->customer_id }}"
                                                                        class="action_btn repay" title="Pay Now"> Pay
                                                                        Now</a>
                                                                @endif
                                                            @endif
                                                            @if ($order->tracking_url)
                                                                <a href="{{ $order->tracking_url }}" class="action_btn"
                                                                    title="Track Order"><i
                                                                        class="fa-solid fa-truck-fast"></i></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="reward-points" class="tab-pane fade">
                                <div class="reward-points-container">
                                    <div class="reward-header">
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <h2><i class="fas fa-coins me-3"></i>{{ __('lang.reward_points') }}</h2>
                                                <p class="mb-0" style="color:#000">
                                                    {{ __('lang.earn_points_description') }}</p>
                                            </div>
                                            <div class="col-md-4 text-end">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    <i class="fas fa-medal me-2"
                                                        style="font-size: 2rem; color: #ffd700;"></i>
                                                    <div>
                                                        <small style="color:#000">{{ __('lang.member_level') }}</small>
                                                        <div class="fw-bold">
                                                            {{ auth()->user()->account_type == 'Reseller' ? 'User' : 'User' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="current-points-card">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <div class="points-display-section">
                                                    <div class="coin-icon-large">
                                                        <i class="fas fa-coins"></i>
                                                    </div>
                                                    <div>
                                                        <h3 class="points-number">
                                                            {{-- getUserAvailablePoints(auth()->user()->id) --}}</h3>
                                                        <div class="points-label">{{ __('lang.total_reward_points') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row text-center">
                                                    <div class="col-4">
                                                        <div class="stat-card">
                                                            <div class="stat-number text-success">
                                                                {{ $thisMonthPoints ?? 125 }}</div>
                                                            <small class="stat-label">{{ __('lang.this_month') }}</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="stat-card">
                                                            <div class="stat-number" style="color: #e490a1;">
                                                                {{ $totalEarnedPoints ?? 890 }}</div>
                                                            <small
                                                                class="stat-label">{{ __('lang.total_earned') }}</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="stat-card">
                                                            <div class="stat-number text-warning">
                                                                {{-- getUserAvailableRedeemPoints(auth()->user()->id) --}}
                                                            </div>
                                                            <small class="stat-label">{{ __('lang.redeemed') }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="earning-info-card">
                                        <h4><i class="fas fa-info-circle me-2"></i>{{ __('lang.how_to_earn_points') }}
                                        </h4>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="earning-method">
                                                    <div class="earning-icon">
                                                        <i class="fas fa-shopping-bag"></i>
                                                    </div>
                                                    <div>
                                                        <h6>{{ __('lang.complete_orders') }}</h6>
                                                        <small>{{ __('lang.earn_points_per_order') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="earning-method">
                                                    <div class="earning-icon">
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <div>
                                                        <h6>{{ __('lang.product_reviews') }}</h6>
                                                        <small>{{ __('lang.bonus_points_reviews') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="points-history-card">
                                        <div class="history-header">
                                            <h4><i class="fas fa-history me-2"></i>{{ __('lang.points_history') }}</h4>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table points-table" id="pointsTable" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('lang.Order_ID') }}</th>
                                                        <th>{{ __('lang.note') }}</th>
                                                        <th>{{ __('lang.points') }}</th>
                                                        <th>{{ __('lang.transaction_at') }}</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="wallet" class="tab-pane fade">
                                <div class="axil-dashboard-address">
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                            <div class="wallet-container">
                                                <div class="wallet-header">
                                                    <h2>{{ __('lang.mywallet') }}</h2>
                                                    <button class="top-up-btn" data-bs-toggle="modal"
                                                        data-bs-target="#topUpModal">{{ __('lang.TOPUP') }}</button>
                                                </div>
                                                <div class="balance-section">
                                                    <h3>{{ config('app.currency') }}
                                                        {{ number_format(auth()->user()->wallet_balance, 2) }}</h3>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="">
                                                        <h6>{{ __('lang.Weekly_Limit') }}</h6>
                                                        <div class="balance-section">
                                                            <h5 class="text-primary">{{ config('app.currency') }}
                                                                {{ number_format(auth()->user()->weekly_limit, 2) }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <h6>{{ __('lang.Weekly_Spent') }}</h6>
                                                        <div class="balance-section">
                                                            <h5 class="text-success">{{ config('app.currency') }}
                                                                {{ number_format(getWeeklySpent(auth()->user()->id), 2) }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="transaction-history">
                                                    <h3>{{ __('lang.Transaction_History') }}</h3>
                                                    <div class="table-responsive">
                                                        <table class="table transaction-table" id="walletTable"
                                                            style="width: 100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{ __('lang.Transaction') }}</th>
                                                                    <th>{{ __('lang.Amount') }}</th>
                                                                    <th>{{ __('lang.Date') }}</th>
                                                                    <th>{{ __('lang.status') }}</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="mycoupons" class="tab-pane fade">
                                <div class="axil-dashboard-address">
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                            <div class="container">
                                                <div class="header">
                                                    <div class="header-number">061</div>
                                                    <h1>{{ __('lang.access_your_coupons') }}</h1>
                                                </div>
                                                <div class="redeem-section">
                                                    <h3>{{ __('lang.redeem_your_coupon') }}</h3>
                                                </div>
                                                <div class="coupon-grid">
                                                    {{-- 
                                                    @if ($coupons->isEmpty())
                                                        <p class="no-coupons">{{ __('lang.no_coupons_available') }}</p>
                                                    @else
                                                        @foreach ($coupons as $coupon)
                                                            @php
                                                                $usagePercentage =
                                                                    ($coupon->used_count / $coupon->usage_limit) * 100;
                                                                $isExpired =
                                                                    $coupon->status === 'inactive' ||
                                                                    $coupon->expiry_date->isPast();
                                                                $isNearExpiry =
                                                                    $coupon->expiry_date->diffInDays() <= 7 &&
                                                                    !$isExpired;
                                                            @endphp
                                                            <div class="coupon-card {{ $isExpired ? 'expired' : '' }}">
                                                                <div class="{{ __('lang.status') }}-indicator"></div>
                                                                <div class="coupon-body">
                                                                    <div class="coupon-value">
                                                                        <div class="value-display">
                                                                            {{ $coupon->type === 'percentage' ? $coupon->value . '%' : '$' . $coupon->value }}
                                                                            OFF
                                                                        </div>
                                                                        <div class="value-label">
                                                                            {{ $coupon->type === 'percentage' ? __('lang.percentage_discount') : __('lang.fixed_amount') }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="coupon-description">
                                                                        {{ $coupon->description }}
                                                                    </div>
                                                                    <div class="coupon-details">
                                                                        <div class="detail-item">
                                                                            <div class="detail-label">
                                                                                {{ __('lang.min_amount') }}</div>
                                                                            <div class="detail-value">
                                                                                ${{ $coupon->min_amount }}</div>
                                                                        </div>
                                                                        <div class="detail-item">
                                                                            <div class="detail-label">
                                                                                {{ __('lang.max_discount') }}</div>
                                                                            <div class="detail-value">
                                                                                {{ $coupon->max_discount ? '$' . $coupon->max_discount : 'No Limit' }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="detail-item">
                                                                            <div class="detail-label">
                                                                                {{ __('lang.valid_until') }}</div>
                                                                            <div class="detail-value">
                                                                                {{ $coupon->expiry_date->format('M d, Y') }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="detail-item">
                                                                            <div class="detail-label">
                                                                                {{ __('lang.status') }}</div>
                                                                            <div class="detail-value">
                                                                                {{ $isExpired ? __('lang.expired') : __('lang.active') }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="usage-section">
                                                                        <div class="usage-header">
                                                                            <span
                                                                                class="usage-label">{{ __('lang.usage_progress') }}</span>
                                                                            <span
                                                                                class="usage-count">{{ $coupon->used_count }}/{{ $coupon->usage_limit }}</span>
                                                                        </div>
                                                                        <div class="progress-bar">
                                                                            <div class="progress-fill"
                                                                                style="width: {{ $usagePercentage }}%">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if ($isNearExpiry && !$isExpired)
                                                                        <div class="expiry-info">
                                                                            {{ __('lang.expires_soon') }}
                                                                            {{ $coupon->expiry_date->format('M d, Y') }}
                                                                        </div>
                                                                    @endif
                                                                    @if ($isExpired)
                                                                        <div class="expiry-info">
                                                                            {{ __('lang.coupon_expired') }}
                                                                            {{ $coupon->expiry_date->format('M d, Y') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="topUpModal" tabindex="-1" aria-labelledby="topUpModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="topUpModalLabel">{{ __('lang.Top_Up_Your_Wallet') }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="walletForm" action="{{ route('wallet.topup') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <label>{{ __('lang.Enter_amount_to_add_to_your_wallet') }} ({{ __('lang.in') }}
                                            {{ config('app.currency') }}):</label>
                                        <input type="number" class="form-control" value="500.00" id="wallet_amount"
                                            name="amount" step="0.1">
                                        <label>{{ __('lang.Select_payment_method') }}:</label>
                                        <div class="payment-methods selected">
                                            <div class="payment-option" data-method="bank">
                                                <input type="radio" name="payment_method" value="bank" checked>
                                                <label>{{ __('lang.ONLINE_BANKING') }}</label>
                                                <p>{{ __('lang.Direct_bank_transfer') }}</p>
                                            </div>
                                            <div class="payment-option" data-method="stripe">
                                                <input type="radio" name="payment_method" value="stripe">
                                                <label>{{ __('lang.Stripe') }}</label>
                                                <p>{{ __('lang.visa_mastercard') }}</p>
                                            </div>
                                            <div class="payment-option" data-method="paydibs">
                                                <input type="radio" name="payment_method" value="paydibs">
                                                <label>{{ __('lang.Paydibs') }}</label>
                                                <p>{{ __('lang.visa_mastercard') }}</p>
                                            </div>
                                        </div>
                                        <div id="payment-details">
                                            <div class="method-details" id="method-card" style="display: none;">
                                            </div>
                                            <div class="method-details" id="method-bank" style="display: block;">
                                                <p><b>{{ __('lang.Bank_Name') }}:</b> {{ __('lang.Maybank') }}</p>
                                                <p><b>{{ __('lang.Title_of_Account') }}:</b> {{ __('lang.Test_Bank') }}
                                                </p>
                                                <p><b>{{ __('lang.Account_No') }}:</b> 00000020023456789</p>
                                                <p><b>{{ __('lang.IBAN') }}:</b> MB00 0000 1111 2222 3333</p>
                                                <p>{{ __('lang.Upload_receipt') }}</p>
                                                <div class="mb-2">
                                                    <input type="file" name="receipt_image" class="form-control"
                                                        id="receipt_image" accept=".jpg, .jpeg, .png">
                                                </div>
                                            </div>
                                            <div class="method-details" id="method-ewallet" style="display: none;">
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="btn-confirm">{{ __('lang.CONFIRM_PAYMENT') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="refundModal" tabindex="-1" aria-labelledby="topUpModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="refundModalLabel">{{ __('lang.Request_Refund') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="requestRefundForm">
                                    @csrf
                                    <div class="modal-body">
                                        <div id="payment-details">
                                            <div class="method-details" id="method-bank" style="display: block;">
                                                <p id="refundManageOrderId"><b>{{ __('lang.Order_ID') }}:</b></p>
                                                <p id="refundManageAmount"><b>{{ __('lang.Amount') }}:</b></p>
                                            </div>
                                        </div>
                                        <div id="form-group" class="mb-4">
                                            <label class="form-label">{{ __('lang.Select_Refund_Method') }}:</label>
                                            <select id="adminRefundMethodSelect" class="form-control">
                                                <option value="Wallet">{{ __('lang.wallet') }}</option>
                                                <option value="Stripe">{{ __('lang.Stripe') }}</option>
                                                <option value="Paydibs">{{ __('lang.Paydibs') }}</option>
                                            </select>
                                        </div>
                                        <input type="hidden" id="modalUserId">
                                        <input type="hidden" id="modalOrderId">
                                        <button type="submit" id="submitRefundRequest"
                                            class="btn-confirm">{{ __('lang.submit') }}</button>
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
@section('scripts')
    <script>
        document.getElementById('cancel-subscription').addEventListener('click', function() {
            let message = `All your collected {{-- getUserAvailablePoints(auth()->user()->id) --}} reward points & members benefits will be gone. Stay active to not let them go to waste!`
            Swal.fire({
                title: '{{ __('lang.are_you_sure') }}',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ __('lang.cancel_it') }}',
                customClass: {
                    confirmButton: 'swal2-cancel-1-f',
                    cancelButton: 'swal2-confirm-1-f'
                },
                cancelButtonText: '{{ __('lang.ok') }}',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("{{ route('user.subscription.cancellation', Auth::user()->id) }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Content-Type": "application/json"
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                Swal.fire(
                                    '{{ __('lang.cancelled') }}',
                                    'Oops, {{ Auth::user()->name }} {{ __('lang.subscription_cancelled_message') }}',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error', 'Something went wrong', 'error');
                            }
                        })
                        .catch(error => {
                            Swal.fire('Error', 'Something went wrong', 'error');
                        });
                }
            });
        });
    </script>
    {{-- @if (session('profile_incomplete')) --}}
    @if (session('profile_incomplete') ||
            (auth()->user()->completed_profile == 0 && auth()->user()->subscription_status == 1))
        <script>
            var profileIncompleteMessage =
                `Hey  ${ "{{ auth()->user()->name }}"}  Want to receive more relevant products next month? Be sure to complete your profile`;
            document?.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Incomplete Profile',
                    text: profileIncompleteMessage,
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonText: "{{ __('lang.complete_profile') }}",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'swal-confirm-button'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('onboarding.show') }}";
                    }
                });
            });
        </script>
    @endif

    {{-- @if ($incompleteOrder == 1 || $abandoned_cart_type == 1) --}}
    @if (auth()->user()->subscription_status == 2)
        <script>
            let user_first_name = "Don’t miss out on this month’s pick, {{ auth()->user()->name ?? '' }}. Grab them before they are gone!";
            Swal.fire({
                title: '{{ __('lang.incomplete') }}',
                text: user_first_name,
                icon: 'warning',
                confirmButtonText: '{{ __('lang.complete_order') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href =
                        "{{ $abandoned_cart_type == 1 ? route('checkout') : route('choose-products') }}";
                }
            });
        </script>
    @endif

    {{-- @if (auth()->user()->subscription_status == 0)
        <script>
            Swal.fire({
                title: '{{ __('lang.reminder') }}',
                text: 'We noticed you havent filled up the form yet. Please complete it to continue.',
                icon: 'warning',
                confirmButtonText: 'Go to Form'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('subscriber-form') }}";
                }
            });
        </script>
    @endif --}}

    {{-- @if ($latestReminder)
        <script>
            Swal.fire({
                title: 'Subscription Reminder',
                text: "{{ $latestReminder->data['message'] ?? 'Time to pick next month goodies!' }}",
                icon: 'info',
                confirmButtonText: 'OK'
            });
        </script>
        @php
            $latestReminder->markAsRead();
        @endphp
    @endif --}}



    @if (auth()->user()->subscription_status == 3)
        <script>
            $(document).ready(function() {
                var resubScribeNowMessage =
                    `Oops,  ${ "{{ auth()->user()->name }}"} Your subscription has been cancelled,resubscribe now to pick your favourite goodies before it's too late!`;
                Swal.fire({
                    title: '{{ __('lang.cancelled') }}',
                    text: resubScribeNowMessage,
                    icon: 'warning',
                    confirmButtonText: '{{ __('lang.resubscribe_now') }}',
                    showCancelButton: false,
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'swal-confirm-button'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('choose-products') }}";
                    }
                });
            });
        </script>

        <style>
            .swal-confirm-button {
                background-color: var(--theme) !important;
                color: #fff !important;
                padding: 10px 20px !important;
                border-radius: 5px !important;
                font-size: 16px !important;
                border: none !important;
                cursor: pointer !important;
            }

            .swal-confirm-button:hover {
                background-color: var(--theme) !important;
            }
        </style>
    @endif


    {{-- @if ($prompt)
        <script>
            @if ($subscriptionStatus === 'cancelled')
                Swal.fire({
                    title: '{{ __('lang.subscription_cancelled') }}',
                    text: '{{ $prompt }}',
                    icon: 'warning',
                    confirmButtonText: '{{ __('lang.resubscribe_now') }}',
                    confirmButtonColor: '#3085d6'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('subscribe-petit') }}";
                    }
                });
            // @elseif ($subscriptionStatus === 'on_hold')
            //     Swal.fire({
            //         title: '{{ __('lang.subscription_on_hold') }}',
            //         text: '{{ $prompt }}',
            //         icon: 'error',
            //         confirmButtonText: '{{ __('lang.reactivate_now') }}',
            //         confirmButtonColor: '#3085d6'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             window.location.href = "{{ route('subscriber-form') }}";
            //         }
            //     });
                // @elseif (!$formCompleted)
                //     Swal.fire({
                //         title: '{{ __('lang.form_required') }}',
                //         text: '{{ $prompt }}',
                //         icon: 'info',
                //         confirmButtonText: '{{ __('lang.fill_form_now') }}',
                //         confirmButtonColor: '#3085d6'
                //     }).then((result) => {
                //         if (result.isConfirmed) {
                //             window.location.href = "{{ route('subscriber-form') }}";
                //         }
                //     });
            @else
                Swal.fire({
                    title: '{{ __('lang.reminder') }}',
                    text: '{{ $prompt }}',
                    icon: 'info',
                    confirmButtonText: '{{ __('lang.ok') }}',
                    confirmButtonColor: '#3085d6'
                });
            @endif
        </script>
    @endif --}}

    {{-- @if (auth()->check())
        @foreach (auth()->user()->unreadNotifications as $notification)
            <script>
                Swal.fire({
                    title: '{{ __('lang.reminder') }}',
                    text: "{{ $notification->data['message'] }}",
                    icon: 'info',
                    confirmButtonText: '{{ __('lang.ok') }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Call route to mark notification as read
                        fetch("{{ route('notifications.read', $notification->id) }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                        });
                    }
                });
            </script>
        @endforeach
    @endif --}}


    @if (auth()->user()->subscription_status == 4)
        <script>
            $(document).ready(function() {
                var paymentFailedMessage =
                    `Uh oh,  ${ "{{ auth()->user()->name }}"} subscription is on hold because of failed payment, reativate them now to get your goodies!`;
                Swal.fire({
                    title: 'Payment Failed',
                    text: paymentFailedMessage,
                    icon: 'warning',
                    confirmButtonText: 'Complete Order',
                    showCancelButton: false,
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'swal-confirm-button'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('choose-products') }}";
                    }
                });
            });
        </script>

        <style>
            .swal-confirm-button {
                background-color: var(--theme) !important;
                color: #fff !important;
                padding: 10px 20px !important;
                border-radius: 5px !important;
                font-size: 16px !important;
                border: none !important;
                cursor: pointer !important;
            }

            .swal-confirm-button:hover {
                background-color: var(--theme) !important;
            }
        </style>
    @endif

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "{{ __('lang.select_option') }}",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                placeholder: "{{ __('lang.select_a_city') }}",
                allowClear: true,
                width: '100%'
            });

            $(window).resize(function() {
                $('.js-example-basic-single').css('width', '100%');
                $('.select2-container').css('width', '100%');
            });
        });
    </script>
    <script>
        $(document).on('click', '.toggle-password', function() {
            const targetInput = $($(this).data('target'));
            const icon = $(this).find('i');

            if (targetInput.attr('type') === 'password') {
                targetInput.attr('type', 'text');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                targetInput.attr('type', 'password');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });
    </script>
    <script>
        $(document).on('click', '.open-refund-modal', function() {
            const orderId = $(this).data('order-id');
            const id = $(this).data('id');
            const customer = $(this).data('customer');
            const amount = $(this).data('amount');
            const {{ __('lang.status') }} = $(this).data('{{ __('lang.status') }}');
            const refund{{ __('lang.status') }} = $(this).data('refund-{{ __('lang.status') }}');
            const userId = $(this).data('user-id');
            const currency = '{{ config('app.currency') }}';
            $('#refundManageOrderId').html('<b>Order ID: </b>' + orderId);
            $('#refundManageAmount').html('<b>Amount: </b>' + amount + ' ' + currency);
            $('#modalUserId').val(userId);
            $('#modalOrderId').val(id);
        });

        $('#requestRefundForm').on('submit', function(e) {
            e.preventDefault();
            const refundMethod = $('#adminRefundMethodSelect').val();
            const userId = $('#modalUserId').val();
            const orderId = $('#modalOrderId').val();
            const $btn = $('#submitRefundRequest');
            $btn.prop('disabled', true).text('Processing...');

            $.ajax({
                url: "{{ route('refund.request.store') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    user_id: userId,
                    order_id: orderId,
                    refund_method: refundMethod
                },
                success: function(res) {
                    toastr.success(res.message);
                    $('#refundModal').modal('hide');
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON.error);
                },
                complete: function() {
                    $btn.prop('disabled', false).text('Submit');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            if ($.fn.DataTable.isDataTable('#orderTable')) {
                $('#orderTable').DataTable().destroy();
            }
            $('#orderTable').DataTable({
                pageLength: 50,
                order: [],
            });

            if ($.fn.DataTable.isDataTable('#walletTable')) {
                $('#walletTable').DataTable().destroy();
            }
            $('#walletTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('wallet.transactions.data') }}",
                order: [
                    [2, 'desc']
                ],
                columns: [{
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'created_at_formatted',
                        name: 'created_at'
                    },
                    {
                        data: 'status_badge',
                        name: 'status_badge',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            if ($.fn.DataTable.isDataTable('#pointsTable')) {
                $('#pointsTable').DataTable().destroy();
            }
            $('#pointsTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('reward.points.data') }}",
                order: [
                    [3, 'desc']
                ],
                columns: [{
                        data: 'order_number',
                        name: 'order_number',
                        render: function(data, type, row) {
                            if (row.order_link) {
                                return '<a href="' + row.order_link + '" class="order-link">#' +
                                    data + '</a>';
                            }
                            return '#' + data;
                        }
                    },
                    {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'points',
                        name: 'points'
                    },
                    {
                        data: 'created_at_formatted',
                        name: 'created_at'
                    },
                ],
                language: {
                    emptyTable: "No Point Records Found",
                    processing: "Loading...",
                    search: "Search:",
                    lengthMenu: "Show _MENU_ Entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ Entries",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                }
            });
        });
    </script>
    <script>
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', () => {
                document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove(
                    'selected'));
                option.classList.add('selected');
                option.querySelector('input[type="radio"]').checked = true;
                const method = option.getAttribute('data-method');
                document.querySelectorAll('.method-details').forEach(div => {
                    div.style.display = 'none';
                });
                document.getElementById('method-' + method).style.display = 'block';
            });
        });

        $(document).ready(function() {
            $('#receipt_image').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const fileType = file.type;
                    const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                    if (!validTypes.includes(fileType)) {
                        toastr.error('Invalid file type. Only JPG, JPEG, and PNG are allowed.');
                        $(this).val('');
                    }
                }
            });

            $('#walletForm').on('submit', function(e) {
                let amount = parseFloat($('#wallet_amount').val());
                let method = $('input[name="payment_method"]:checked').val();
                let receipt = $('#receipt_image')[0]?.files[0];

                if (isNaN(amount) || amount < 20) {
                    e.preventDefault();
                    toastr.error('Minimum top-up amount is RM 20.');
                    return;
                }

                if (method === 'bank') {
                    if (!receipt) {
                        e.preventDefault();
                        toastr.error('Please upload your bank transfer receipt.');
                        return;
                    }
                    const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                    if (!validTypes.includes(receipt.type)) {
                        e.preventDefault();
                        toastr.error('Invalid file type. Only JPG, JPEG, PNG are allowed.');
                        $('#receipt_image').val('');
                        return;
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.repay').click(function() {
                var order_id = $(this).data('order');
                var customer_id = $(this).data('customer');
                var options = {
                    "key": "{{ config('services.razorpay.secret') }}",
                    "order_id": order_id,
                    "customer_id": customer_id,
                    "recurring": "0",
                    "handler": function(response) {
                        alert('Payment successful! Payment ID: ' + response.razorpay_payment_id);
                    },
                    "notes": {
                        "note_key_1": "Beam me up Scotty",
                        "note_key_2": "Tea. Earl Gray. Hot."
                    },
                    "theme": {
                        "color": "#F37254"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
            });

            $(document).on('click', '.remove-cart-item', function() {
                var $item = $(this).closest('li');
                var product_id = $item.data('product-id');
                var is_model = $item.data('is-model') === 1;
                var data = {
                    _token: '{{ csrf_token() }}',
                    product_id: product_id,
                    is_model: is_model
                };
                Swal.fire({
                    title: '{{ __('lang.are_you_sure') }}',
                    text: '{{ __('lang.do_you_to_remove_this_item') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, remove it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('cart.remove') }}",
                            method: 'POST',
                            data: data,
                            success: function(response) {
                                if (response.success) {
                                    toastr.success(response.message);
                                    updateCartSidebar(response.cartItems, response
                                        .totalPrice);
                                    updateCartCount(response.cartCount);
                                } else {
                                    toastr.error('Failed to remove item.');
                                }
                            },
                            error: function(xhr) {
                                toastr.error('Failed to remove item.');
                            }
                        });
                    }
                });
            });

            // function updateCartSidebar(cartItems, totalPrice) {
            //     var $cartList = $('.menu-cart.style-2 .cart-box ul');
            //     var $cartTotal = $('.totalPrice');
            //     $cartList.empty();
            //     if (cartItems.length > 0) {
            //         var groupedItems = {};
            //         var localTotalPrice = 0;
            //         $.each(cartItems, function(index, item) {
            //             var productId = item.product_id || item.id;
            //             if (!groupedItems[productId]) {
            //                 groupedItems[productId] = {
            //                     ...item,
            //                     quantity: 0
            //                 };
            //             }
            //             groupedItems[productId].quantity += parseInt(item.quantity, 10);
            //             localTotalPrice += parseFloat(item.price) * parseInt(item.quantity, 10);
            //         });
            //         $.each(groupedItems, function(productId, item) {
            //             var photo = item.image ?
            //                 (item.image.includes(',') ?
            //                     window.baseURL + '/' + item.image.split(',')[0].trim() :
            //                     window.baseURL + '/' + item.image) :
            //                 window.baseURL + '/front/assets/img/product/01.jpg';
            //             var cartItemHtml = `
        //                 <li data-product-id="${item.id}" data-is-model="0">
        //                     <a href="javascript:void(0);" class="remove remove-cart-item" title="Remove this item">
        //                         <i class="fa fa-remove"></i>
        //                     </a>
        //                     <img src="${photo}" alt="${item.name}" />
        //                     <div class="cart-product">
        //                         <a href="{{ route('product.detail', '') }}/${item.slug}" target="_blank">
        //                             ${item.name}
        //                         </a>
        //                         <span>RM ${parseFloat(item.price).toFixed(2)}</span>
        //                         <p class="quantity">${item.quantity} x</p>
        //                     </div>
        //                 </li>`;
            //             $cartList.append(cartItemHtml);
            //         });
            //         $cartTotal.text(`RM ${parseFloat(totalPrice).toFixed(2)}`);
            //         $('.menu-cart.style-2 .cart-box .cart-button').show();
            //     } else {
            //         $cartList.append('<li>No items in cart.</li>');
            //         $cartTotal.text(`RM 0.00`);
            //         $('.menu-cart.style-2 .cart-box .cart-button').hide();
            //     }
            // }

            function updateCartCount(count) {
                var $cartIconCount = $('.menu-cart.style-2 .cart-icon .total-count');
                if (count > 0) {
                    $cartIconCount.text(count).show();
                } else {
                    $cartIconCount.hide();
                }
            }

            var $menuCart = $(".menu-cart.style-2");
            var $cartBox = $menuCart.find(".cart-box");
            var $cartIcon = $menuCart.find(".cart-icon");
            $cartBox.hide();
            $cartIcon.on("click", function(e) {
                e.preventDefault();
                $cartBox.toggle();
            });
            $(document).on("click", function(e) {
                if (!$menuCart.is(e.target) && $menuCart.has(e.target).length === 0) {
                    $cartBox.hide();
                }
            });
            var $closeHeader = $("#cartCloseHeader");
            if ($closeHeader.length) {
                $closeHeader.on("click", function() {
                    $closeHeader.closest(".cart-box").hide();
                });
            }
            $(document).on("mousedown", function(e) {
                if ($cartBox.is(":visible") && !$cartBox.is(e.target) && $cartBox.has(e.target).length ===
                    0) {
                    $cartBox.hide();
                }
            });
        });
    </script>

    {{-- @if (isset($lastDaysExpireSubription) && !is_null($lastDaysExpireSubription)) --}}
        {{-- @if (!is_null($lastDaysExpireSubription) && $lastDaysExpireSubription || !is_null($subChooseModal) &&  $subChooseModal == true)
            <script>
                let sub_expire_date = null;
                let sub_exp_date = '';
                $(document).ready(function() {
                    @if(isset($last7DaysExpireSub) && !empty($last7DaysExpireSub->sub_expiry))
                    sub_exp_date = "{{$last7DaysExpireSub->sub_expiry}}";
                    @else
                    sub_exp_date = "{{auth()->user()->sub_expiry}}";
                    @endif 
                    sub_expire_date = sub_exp_date;
                    var last7DaysExpireSubMessage = `Psst {{ auth()->user()->name }}, time to pick next month’s goodies! 🎁 We’ll auto-pick for you if you don’t choose before ${sub_expire_date}`;

                    Swal.fire({
                        title: '{{ __('lang.incomplete') }}',
                        text: last7DaysExpireSubMessage,
                        icon: 'warning',
                        confirmButtonText: 'Choose now',
                        showCancelButton: false,
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: 'swal-confirm-button'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            "{{ Session::put('sub_session_chosse_product', true) }}"; 
                            window.location.href = "{{ route('sub-choose-products') }}";
                        }
                    });
                });
            </script>
        @endif
        --}}
    {{-- @endif --}}


    <script>
        function addChildDob() {
            const container = document.getElementById('child_dobs_container');
            const inputGroup = document.createElement('div');
            inputGroup.className = 'input-group mb-2';
            inputGroup.innerHTML = `
        <input type="date" name="child_dobs[]" class="form-control">
        <button type="button" class="btn btn-danger remove-dob">Remove</button>
    `;
            container.appendChild(inputGroup);
            updateRemoveButtons();
        }

        function updateRemoveButtons() {
            const container = document.getElementById('child_dobs_container');
            const removeButtons = container.querySelectorAll('.remove-dob');
            if (removeButtons.length > 1) {
                removeButtons.forEach(button => button.style.display = 'block');
            } else {
                removeButtons.forEach(button => button.style.display = 'none');
            }
        }

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-dob')) {
                e.target.closest('.input-group').remove();
                updateRemoveButtons();
            }
        });

        document.addEventListener('DOMContentLoaded', updateRemoveButtons);
    </script>
@endsection
