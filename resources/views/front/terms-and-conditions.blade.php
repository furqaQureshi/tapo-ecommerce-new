@extends('front.layouts.urwah_partials.app')
@section('content')

<main>
    <!--====== Start Page Banner ======-->
    <section class="page-banner bg_cover p-r z-1" style="background-image: url(assets/images/home/hero/hero-bg-1.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="page-content text-center">
                        <h1>Terms & Conditions</h1>
                        <ul>
                            <li><a href="{{ route('front.home') }}">Home</a></li>
                            <li>/</li>
                            <li>Terms & Conditions</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Page Banner ======-->

    <!--====== Terms & Conditions Section ======-->
    <section class="py-5 policy-pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">

                    <div class="op-main-container text-center">

                        <div class="op-checkmark-container">
                            <div class="op-checkmark"><i class="fas fa-file-contract"></i></div>
                        </div>

                        {{-- <h1 class="op-title">Terms & Conditions</h1> --}}
                        <p class="op-subtitle">
                            Please read our Terms carefully before using our services.
                        </p>

                        <!-- CLEAN POINTS – PERFECT ALIGNMENT – NO BACKGROUND -->
                        <div class="op-order-details" style="text-align:left; max-width:800px; margin:auto;">

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">1. General</h5>
                                <p class="text-muted">
                                    These Terms and Conditions govern the use of the Tapo website and services offered by
                                    <strong>Akdapur Sdn. Bhd.</strong>
                                    By placing an order, you agree to be bound by these Terms.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">2. Eligibility</h5>
                                <p class="text-muted">
                                    Customers must be at least <strong>18 years old</strong> and legally capable of entering into binding contracts.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">3. Product Information</h5>
                                <p class="text-muted">
                                    We strive for accuracy in product descriptions, images, and pricing.
                                    In case of an error, we reserve the right to correct it and revise your order if necessary.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">4. Pricing and Payment</h5>
                                <p class="text-muted">
                                    All prices are in <strong>Malaysian Ringgit (MYR)</strong> and inclusive of taxes unless stated otherwise.
                                    Full payment is required before order processing.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">5. Invoicing</h5>
                                <p class="text-muted">
                                    Customers must provide complete billing details, including Tax Identification Number (TIN) where applicable.
                                    E-invoices are issued according to <strong>LHDN regulations</strong>.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">6. Order Acceptance</h5>
                                <p class="text-muted">
                                    An order confirmation email does not guarantee final acceptance.
                                    We may cancel orders due to stock issues or operational constraints.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">7. Cancellations</h5>
                                <p class="text-muted">
                                    Orders may be canceled within <strong>24 hours</strong> if they are not yet processed or shipped.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">8. Returns and Refunds</h5>
                                <p class="text-muted">
                                    Returns and refunds follow our official Returns & Refunds Policy.
                                    No refunds for <strong>change of mind</strong>.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">9. Limitation of Liability</h5>
                                <p class="text-muted">
                                    Our liability is limited to the value of the goods purchased.
                                    We are not responsible for indirect or consequential damages.
                                </p>
                            </div>

                            <div>
                                <h5 class="fw-bold mb-1">10. Governing Law</h5>
                                <p class="text-muted">
                                    These Terms and Conditions are governed by the laws of <strong>Malaysia</strong>.
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
