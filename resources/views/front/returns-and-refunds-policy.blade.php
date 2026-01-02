@extends('front.layouts.urwah_partials.app')
@section('content')

<main>
    <!--====== Start Page Banner ======-->
    <section class="page-banner bg_cover p-r z-1" style="background-image: url(assets/images/home/hero/hero-bg-1.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="page-content text-center">
                        <h1>Returns & Refunds Policy</h1>
                        <ul>
                            <li><a href="{{ route('front.home') }}">Home</a></li>
                            <li>/</li>
                            <li>Returns & Refunds Policy</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Page Banner ======-->

    <!--====== Returns & Refunds Policy Section ======-->
    <section class="py-5 policy-pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">

                    <div class="op-main-container text-center">

                        <div class="op-checkmark-container">
                            <div class="op-checkmark"><i class="fas fa-undo-alt"></i></div>
                        </div>

                        <p class="op-subtitle">
                            Everything you need to know about returning products and receiving refunds.
                        </p>

                        <div class="op-order-details" style="text-align:left; max-width:800px; margin:auto;">

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">1. Non-Returnable Items</h5>
                                <p class="text-muted">
                                    All products are sold on a final-sale basis. We do not accept returns for change of mind due to hygiene and product integrity standards.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">2. Defective or Incorrect Items</h5>
                                <p class="text-muted">
                                    Returns are only accepted in cases where products are defective, damaged during delivery, or not as described. Claims must be made within forty-eight (48) hours of delivery with supporting evidence.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">3. Return Process</h5>
                                <p class="text-muted">
                                    Customers must contact customer service with order details and evidence. If approved, return instructions will be provided. Items must be returned in their original condition and packaging.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">4. Refunds</h5>
                                <p class="text-muted">
                                    Refunds are processed within seven (7) to fourteen (14) business days upon receipt and verification of returned goods. Refunds are issued via the original payment method.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">5. Exchanges</h5>
                                <p class="text-muted">
                                    Exchanges are offered only for incorrect or defective items, subject to stock availability.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">6. Marketplace Purchases</h5>
                                <p class="text-muted">
                                    Orders placed via Shopee, Lazada, or TikTok Shop are subject to the respective platform’s return and refund policies.
                                </p>
                            </div>

                            <div style="margin-bottom:20px;">
                                <h5 class="fw-bold mb-1">7. Contact</h5>
                                <p class="text-muted">
                                    For all return or refund requests, contact <strong>hello@tapo.com.my</strong> with your order ID and supporting documentation.
                                </p>
                            </div>

                            <div>
                                <h5 class="fw-bold mb-1">8. Legal Compliance</h5>
                                <p class="text-muted">
                                    This policy adheres to the Consumer Protection Act 1999 and relevant Malaysian regulations.
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
