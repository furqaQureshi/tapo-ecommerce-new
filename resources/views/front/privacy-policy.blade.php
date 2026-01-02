@extends('front.layouts.urwah_partials.app')
@section('content')

<main>
    <!--====== Start Page Banner ======-->
    <section class="page-banner bg_cover p-r z-1" style="background-image: url(assets/images/home/hero/hero-bg-1.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="page-content text-center">
                        <h1>Privacy Policy</h1>
                        <ul>
                            <li><a href="{{ route('front.home') }}">Home</a></li>
                            <li>/</li>
                            <li>Privacy Policy</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Page Banner ======-->

    <!--====== Privacy Policy Section ======-->
    <section class="py-5 policy-pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">

                    <div class="op-main-container text-center">

                        <div class="op-checkmark-container">
                            <div class="op-checkmark"><i class="fas fa-user-shield"></i></div>
                        </div>

                        {{-- <h1 class="op-title">Privacy Policy</h1> --}}
                        <p class="op-subtitle">
                            How we collect, use, and protect your personal information.
                        </p>

                        <!-- CLEAN POINTS – PERFECT ALIGNMENT – NO BACKGROUND -->
                        <div class="op-order-details" style="text-align:left; max-width:800px; margin:auto;">

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">1. Introduction</h5>
                                <p class="text-muted">
                                    Tapo respects your privacy and is committed to protecting your personal data
                                    in accordance with the <strong>Personal Data Protection Act 2010 (PDPA)</strong>.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">2. Information Collected</h5>
                                <p class="text-muted">
                                    We collect data you provide during registration, order placement, or newsletter
                                    subscription. This may include your name, contact details, delivery address,
                                    payment information, and TIN when required.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">3. Use of Data</h5>
                                <p class="text-muted">
                                    Your personal data is used for order processing, invoicing, customer support,
                                    and — with your consent — marketing communications.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">4. Data Sharing</h5>
                                <p class="text-muted">
                                    Information may be shared with payment providers, courier services, and relevant
                                    authorities strictly for operational and compliance purposes.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">5. Data Security</h5>
                                <p class="text-muted">
                                    We follow industry-standard security measures to safeguard your data from
                                    unauthorized access, misuse, and breaches.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">6. Retention</h5>
                                <p class="text-muted">
                                    Your personal data is retained only for as long as necessary to meet legal,
                                    regulatory, and operational requirements.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">7. Your Rights</h5>
                                <p class="text-muted">
                                    You may request access, correction, or deletion of your data by contacting our
                                    <strong>Data Protection Officer</strong>.
                                </p>
                            </div>

                            <div>
                                <h5 class="fw-bold mb-1">8. Cookies</h5>
                                <p class="text-muted">
                                    We use cookies to enhance browsing experience.
                                    You may disable cookies through your browser settings, but some features may not function properly.
                                </p>
                            </div>

                        </div>

                        <div class="op-btn-group mt-4">
                            <a href="{{ route('front.home') }}" class="op-btn op-btn-primary">Back to Home</a>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </section>

</main>

@endsection
