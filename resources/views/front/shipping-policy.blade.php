@extends('front.layouts.urwah_partials.app')
@section('content')

<main>
    <!--====== Start Page Banner ======-->
    <section class="page-banner bg_cover p-r z-1" style="background-image: url(assets/images/home/hero/hero-bg-1.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="page-content text-center">
                        <h1>Shipping Policy</h1>
                        <ul>
                            <li><a href="{{ route('front.home') }}">Home</a></li>
                            <li>/</li>
                            <li>Shipping Policy</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Page Banner ======-->

    <!--====== Shipping Policy Section ======-->
    <section class="py-5 policy-pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">

                    <div class="op-main-container text-center">

                        <div class="op-checkmark-container">
                            <div class="op-checkmark"><i class="fas fa-shipping-fast"></i></div>
                        </div>

                        {{-- <h1 class="op-title">Our Shipping Policy</h1> --}}
                        <p class="op-subtitle">
                            Everything you need to know about how your order ships safely and on time.
                        </p>

                        <!-- CLEAN POINTS – PERFECT ALIGNMENT – NO BACKGROUND -->
                        <div class="op-order-details" style="text-align:left; max-width:800px; margin:auto;">

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">1. Scope</h5>
                                <p class="text-muted">
                                    This Shipping Policy applies to all purchases made through
                                    <strong>Tapo.com.my</strong> operated by
                                    <strong>Akdapur Sdn. Bhd. (SSM No. 202501028349)</strong>.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">2. Shipping Coverage</h5>
                                <p class="text-muted">
                                    We ship exclusively within <strong>Malaysia</strong> — Peninsular & East Malaysia.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">3. Processing Time</h5>
                                <p class="text-muted">
                                    Orders are processed within <strong>1–3 business days</strong>, excluding weekends & public holidays.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">4. Delivery Services</h5>
                                <p class="text-muted">
                                    Standard shipments via <strong>J&T Express</strong> & <strong>DHL eCommerce</strong>.
                                    Urgent Klang Valley deliveries may use <strong>Lalamove</strong>.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">5. Shipping Charges</h5>
                                <p class="text-muted">
                                    Charges calculated based on weight, size & location. Visible at checkout before payment.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">6. Order Tracking</h5>
                                <p class="text-muted">
                                    Tracking number is sent via Email or SMS once shipped.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">7. Risk of Loss</h5>
                                <p class="text-muted">
                                    Risk transfers to the customer once delivered to the provided address.
                                </p>
                            </div>

                            <div >
                                <h5 class="fw-bold mb-1">8. Delivery Issues</h5>
                                <p class="text-muted">
                                    For any damage, loss, or non-delivery, contact us within <strong>3 days</strong> of expected delivery.
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
