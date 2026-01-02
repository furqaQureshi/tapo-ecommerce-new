 <!--<< Header Area >>-->

 <head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="author" content="Brainiac Creation">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ======== Page title ============ -->
    {{-- <title>@yield('title') | {{ config('app.name') }}</title> --}}
    <title>Tapo - Biodegradable Food Packaging</title>
    <!--<< Favcion >>-->
    <link rel="shortcut icon" href="{{ asset('front/assets/img/logo-favicon.jpg') }}">
    <!--<< Bootstrap min.css >>-->
    <link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css') }}">
    <!--<< All Min Css >>-->
    <link rel="stylesheet" href="{{ asset('front/assets/css/all.min.css') }}">
    <!--<< Animate.css >>-->
    <link rel="stylesheet" href="{{ asset('front/assets/css/animate.css') }}">
    <!--<< Magnific Popup.css >>-->
    <link rel="stylesheet" href="{{ asset('front/assets/css/magnific-popup.css') }}">
    <!--<< MeanMenu.css >>-->
    <link rel="stylesheet" href="{{ asset('front/assets/css/meanmenu.css') }}">
    <!--<< Swiper Bundle.css >>-->
    <link rel="stylesheet" href="{{ asset('front/assets/css/swiper-bundle.min.css') }}">
    <!--<< Nice Select.css >>-->
    <link rel="stylesheet" href="{{ asset('front/assets/css/nice-select.css') }}">
    <!--<< Color.css >>-->
    <link rel="stylesheet" href="{{ asset('front/assets/css/color.css') }}">
    <!--<< Main.css >>-->
    <link rel="stylesheet" href="{{ asset('front/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


        {{-- Tapu Links --}}

        <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">
        <!--====== Google Fonts ======-->
        <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <!--====== Flaticon css ======-->
        <link rel="stylesheet" href="{{ asset('assets/fonts/flaticon/flaticon_bistly.css') }}">
        <!--====== FontAwesome css ======-->
        <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/all.min.css') }}">
        <!--====== Bootstrap css ======-->
        <link rel="stylesheet" href="{{ asset('assets/css/plugins/bootstrap.min.css') }}">
        <!--====== Slick-popup css ======-->
        <link rel="stylesheet" href="{{ asset('assets/css/plugins/slick.css') }}">
        <!--====== Magnific-popup css ======-->
        <link rel="stylesheet" href="{{ asset('assets/css/plugins/magnific-popup.css') }}">
        <!--====== Nice Select CSS ======-->
        <link rel="stylesheet" href="{{ asset('assets/css/plugins/nice-select.css') }}">
        <!--====== AOS Animation ======-->
        <link rel="stylesheet" href="{{ asset('assets/css/plugins/aos.css') }}">
        <!--====== Common Style css ======-->
        <link rel="stylesheet" href="{{ asset('assets/css/common-style.css') }}">
        <!--====== Style css ======-->
        <link rel="stylesheet" href="{{ asset('assets/css/pages/innerpages.css') }}">
        <!--====== Style css ======-->
        <link rel="stylesheet" href="{{ asset('assets/css/pages/home.css') }}">

        {{-- tapu links end --}}

    @yield('head')
    @stack('head')
 </head>
