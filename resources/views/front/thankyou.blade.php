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
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <div class="op-main-container text-center">
                                            <div class="op-checkmark-container">
                                                <div class="op-checkmark"><i class="fas fa-check"></i></div>
                                            </div>
                                            
                                            <h1 class="op-title">Order Complete!</h1>
                                            <p class="op-subtitle">
                                                Thank you for your purchase! Your order has been successfully placed and is being processed.
                                            </p>
                                            
                                            <div class="op-order-details">
                                                <div class="op-order-row">
                                                    <span>Order Number:</span>
                                                    <span>#ORD-2025-7892</span>
                                                </div>
                                                <div class="op-order-row">
                                                    <span>Order Date:</span>
                                                    <span>August 27, 2025</span>
                                                </div>
                                                <div class="op-order-row">
                                                    <span>Payment Method:</span>
                                                    <span>Credit Card</span>
                                                </div>
                                                <div class="op-order-row">
                                                    <span>Delivery Address:</span>
                                                    <span>Karachi, Sindh, Pakistan</span>
                                                </div>
                                                <div class="op-order-row">
                                                    <span>Estimated Delivery:</span>
                                                    <span>3-5 Business Days</span>
                                                </div>
                                                <div class="op-order-row">
                                                    <span>Total Amount:</span>
                                                    <span>PKR 2,850</span>
                                                </div>
                                            </div>
                                            
                                            <div class="op-btn-group">
                                                <a href="#" class="op-btn op-btn-primary">Track Your Order</a>
                                                <a href="#" class="op-btn op-btn-secondary">Continue Shopping</a>
                                            </div>
                                            
                                            <div class="op-social-share">
                                                <p>Share your experience with friends!</p>
                                                <div class="op-social-icons">
                                                    <a href="#" class="op-social-icon op-facebook"><i class="fab fa-facebook-f"></i></a>
                                                    <a href="#" class="op-social-icon op-instagram"><i class="fab fa-instagram"></i></a>
                                                    <a href="#" class="op-social-icon op-whatsapp"><i class="fab fa-whatsapp"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!--====== End Menu List Section ======-->
                </main>
            @endsection