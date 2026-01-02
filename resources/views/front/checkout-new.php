
@extends('front.layouts.urwah_partials.app')
@section('content')



    <main>
                    <!--====== Start Page Banner ======-->
                    <section class="page-banner bg_cover p-r z-1" style="background-image: url(assets/images/home/hero/hero-bg-1.jpg);">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-10">
                                    <div class="page-content text-center">
                                        <h1>Checkout</h1>
                                        <ul>
                                            <li><a href="#">Home</a></li>
                                            <li>/</li>
                                            <li>Checkout</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!--====== End Page Banner ======-->
                    <!--====== Start Checkout Page  ======-->
                    <section class="bistly-checkout py-5 primary-bgcolor-3">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8">
                                    <!-- Bistly Billing Wrapper -->
                                    <div class="bistly-billing-wrapper">
                                        <!-- Billing Wrapper -->
                                        <div class="billing-wrapper">
                                            <h4 class="mb-4">Billing Address:</h4>
                                            <form autocomplete="off" action="{{ route('checkout.save') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>First Name</label>
                                                            <input type="text" class="form_control" placeholder="Enter first name" name="first_name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Last Name</label>
                                                            <input type="text" class="form_control" placeholder="Enter last name" name="last_name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Email Address</label>
                                                            <input type="email" class="form_control" placeholder="Enter email" name="email" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                     <div class="form-group">
                                                           <label>Phone Number</label>
                                                            <input type="phone" class="wide form_control" placeholder="Phone Number" name="phone" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>State</label>
                                                            <select class="wide form_control" name="state">
                                                                <option value="1">Select state</option>
                                                                <option value="2">New York</option>
                                                                <option value="3">London</option>
                                                                <option value="4">Ontario</option>
                                                                <option value="6">Berlin</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>City</label>
                                                            <input type="text" class="wide form_control" placeholder="Enter Your City" name="city" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Zip/Postal Code</label>
                                                            <input type="text" class="form_control" placeholder="Enter zip code" name="zipcode" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            {{-- </form> --}}
                                        </div>
                                        <!-- Payment Area -->
                                        <div class="payment-method">
                                            <ul id="paymentMethod" class="mb-20">
                                                <!-- Default unchecked -->
                                                <li class="form-check">
                                                    {{-- <label class="form-check-label" for="method1" data-bs-toggle="collapse" data-bs-target="#collapse0" aria-expanded="true">
                                                        <input class="form-input-radio" type="radio" name="payment_method" value="card" id="method1" checked>
                                                        Debit/Credit Card
                                                    </label> --}}
                                                    <div id="collapse0" class="collapse show" data-bs-parent="#paymentMethod">
                                                    <div class="payment-form mt-4">
                                                        {{-- <form autocapitalize="off" class="payment-form mt-4"> --}}
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    {{-- <div class="form-group">
                                                                        <label>Card Number</label>
                                                                        <span class="pay"><img src="assets/images/innerpage/shop/pay.png" alt="pay"></span>
                                                                        <input type="text" class="form_control" placeholder="Enter card number" name="card_number" required>
                                                                    </div> --}}
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        {{-- <label>Expiration date</label> --}}
                                                                        {{-- <div class="row"> --}}
                                                                            {{-- <div class="col-lg-6">
                                                                                <select class="wide form_control" name="month">
                                                                                    <option value="01">Month</option>
                                                                                    <option value="02">January</option>
                                                                                    <option value="03">February</option>
                                                                                    <option value="04">March</option>
                                                                                    <option value="05">April</option>
                                                                                    <option value="06">May</option>
                                                                                    <option value="07">June</option>
                                                                                    <option value="08">July</option>
                                                                                    <option value="09">August</option>
                                                                                    <option value="10">September</option>
                                                                                    <option value="11">October</option>
                                                                                    <option value="12">November</option>
                                                                                    <option value="13">December</option>
                                                                                </select>
                                                                            </div> --}}
                                                                            {{-- <div class="col-lg-6">
                                                                                <select class="wide form_control" name="year">
                                                                                    <option value="01">Year</option>
                                                                                    <option value="02">2025</option>
                                                                                    <option value="03">2026</option>
                                                                                    <option value="04">2027</option>
                                                                                    <option value="05">2028</option>
                                                                                    <option value="06">2029</option>
                                                                                    <option value="07">2030</option>
                                                                                </select>
                                                                            </div> --}}
                                                                        {{-- </div> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    {{-- <div class="form-group">
                                                                        <label>Security Code</label>
                                                                        <input type="text" class="form_control" placeholder="Enter card number" name="security_code" required>
                                                                    </div> --}}
                                                                </div>
                                                            </div>

                                                            <div class="place-order">
                                                                <button class="theme-btn style-one" type="submit">Place Order Now</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <!-- Billing Sidebar -->
                                    <div class="billing-sidebar">
                                        <div class="checkout-total-box mb-4">
                                        @if(!empty($cartItems1))
                                            <h4 class="item-title">Items <span>Price</span></h4>
                                            <ul class="checkout-list">
                                                 @foreach($cartItems1 as $key=>$cartItem)
                                                <li>
                                                    <div class="list-item">
                                                        <div class="item-title">{{ $cartItem['name']}} <span>{{ $cartItem['quantity']}}x</span></div>
                                                        <div class="price">${{ $cartItem['total_price']}}</div>
                                                    </div>
                                                </li>
                                                @endforeach
                                                <li>
                                                    <div class="list-item">
                                                        <div class="item-title">Grand Total </div>
                                                        <div class="total-price">${{$grandTotal}}</div>
                                                    </div>
                                                </li>
                                            </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!--====== End Checkout Page  ======-->
                </main>

@stop

