  <!-- footer-section Start -->
  {{-- <footer class="footer-section footer-bg-2 fix">
      <div class="container">
          <div class="footer-widget-wrapper style-2">
              <div class="row">
                  <div class="col-xl-3 col-lg-4 col-md-4 wow fadeInUp" data-wow-delay=".2s">
                      <div class="single-footer-widget">
                          <div class="widget-head">
                              <a href="{{ route('front.home') }}" class="footer-logo">
                                  <img src="{{ asset('front/assets/img/logo/logo.png') }}" alt="logo-img">
                              </a>
                          </div>
                          <div class="footer-content">
                              <div class="social-item">
                                      <small class="color-theme-4">{{ __('lang.Connectwithus') }}</small>
                                  <div class="social-icon d-flex align-items-center">
                                      <a href="https://www.facebook.com/zeramom.official" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                      <a href="https://www.instagram.com/zeramom.official/" target="_blank"><i class="fab fa-instagram"></i></a>
                                      <a href="https://www.tiktok.com/@zeramom.official" target="_blank"><i class="fab fa-tiktok"></i></a>
                                      <a href="https://wa.me/60172834522" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                      <!--@php
                                          $iconMap = [
                                              'Facebook' => 'fab fa-facebook-f',
                                              'Instagram' => 'fab fa-instagram',
                                              'Tiktok' => 'fa-brands fa-tiktok',
                                              'WhatsApp' => 'fab fa-whatsapp',
                                          ];
                                      @endphp
                                      @foreach ($followUsFooterSections['Follow Us'] ?? [] as $item)
                                          <a href="{{ $item->link_url }}" target="_blank" rel="noopener">
                                              <i class="{{ $iconMap[$item->link_text] ?? '' }}"></i>
                                          </a>
                                      @endforeach-->
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 ps-lg-5 wow fadeInUp" data-wow-delay=".4s">
                      <div class="single-footer-widget">
                          <div class="widget-head">
                              <h3>{{ __('lang.myaccount') }}</h3>
                          </div>
                          <ul class="list-items">
                              <li>
                                  <a href="#">
                                      {{ __('lang.track_orders') }}
                                  </a>
                              </li>
                              <li>
                                  <a href="#">
                                      {{ __('lang.shipping') }}
                                  </a>
                              </li>
                              <li>
                                  <a href="#">
                                      {{ __('lang.wishlist') }}
                                  </a>
                              </li>
                              <li>

                                  @auth
                                      <a href="{{ route('myaccount') }}">
                                          {{ __('lang.myaccount') }}
                                      </a>
                                  @else
                                      <a href="{{ route('login') }}">
                                          {{ __('lang.login') }}
                                      </a>
                                  @endauth
                              </li>
                              <li>
                                  <a href="#">
                                      {{ __('lang.order_history') }}
                                  </a>
                              </li>
                              <li>
                                  <a href="#">
                                      {{ __('lang.returns') }}
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 ps-lg-5 wow fadeInUp" data-wow-delay=".6s">
                      <div class="single-footer-widget">
                          <div class="widget-head">
                              <h3>{{ __('lang.infomation') }}</h3>
                          </div>
                          <ul class="list-items">
                              <li>
                                  <a href="#">
                                      {{ __('lang.our_story') }}
                                  </a>
                              </li>
                              <li>
                                  <a href="#">
                                      {{ __('lang.careers') }}
                                  </a>
                              </li>
                              <li>
                                  <a href="#">
                                      {{ __('lang.privacy_policy') }}
                                  </a>
                              </li>
                              <li>
                                  <a href="#">
                                      {{ __('lang.Terms_&_Conditions') }}
                                  </a>
                              </li>
                              <li>
                                  <a href="{{ route('front.about') }}">
                                      {{ __('lang.aboutus') }}
                                  </a>
                              </li>
                              <li>
                                  <a href="{{ route('front.contact') }}">
                                      {{ __('lang.contactus') }}
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".8s">
                      <div class="single-footer-widget">
                          <div class="widget-head">
                              <h3>{{ __('lang.talk_to_us') }}</h3>
                          </div>
                          <div class="footer-content">
                              <div class="text">
                                  <p>{{ __('lang.got_questions_call_us') }}</p>
                                  <a href="tel:+60172834522">+60 17-283 4522</a>
                              </div>
                              <ul class="contact-list">
                                  <li>
                                      <i class="fa-regular fa-envelope"></i>
                                      <a href="mailto:cartly@gmail.com">hello@zerapostpartum.com</a>
                                  </li>
                                  <li>
                                      <i class="fa-regular fa-location-dot"></i>
                                      8A, JALAN MELAKA RAYA 15,<br> 75000 Melaka
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="footer-bottom">
              <div class="footer-wrapper">
                  <p class="wow fadeInUp" data-wow-delay=".3s">
                      © {{ date('Y') }} ZERA MOM SDN BHD 202501026505 (1627917-D). {{ __('lang.AllRightsReserved') }}
                  </p>
              </div>
          </div>
      </div>
  </footer> --}}



   <!--====== Start Footer ======-->
                    <footer class="default-footer rs-footer primary-bgcolor-1 pt-5 p-r z-1">
                        <div class="shape shape-one"><img src="assets/images/home/footer/shape1.png" alt="shape"></div>
                        <div class="shape shape-two"><img src="assets/images/home/footer/shape2.png" alt="shape"></div>
                        <div class="container">
                            <!-- Footer Widget Area -->
                            <div class="footer-widget-area py-5">
                                <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <!-- Footer Widget -->
                                    <div class="footer-widget footer-about-widget mb-4 pb-3" data-aos="fade-up" data-aos-duration="800">
                                        <div class="widget-content">
                                            <a href="index.html" class="mb-2"><img src="assets/images/home/logo/logo-white.png" alt="Brand Logo"></a>
                                            <div class="social-box">
                                                <a href="https://www.facebook.com/tapo.com.my/"><i class="fab fa-facebook-f"></i></a>
                                                <a href="https://www.tiktok.com/@tapo362"><i class="fab fa-tiktok"></i></a>
                                                <a href="https://www.instagram.com/tapo.com.my"><i class="fab fa-instagram"></i></a>
                                                <a href="mailto:hello@tapo.com.my?subject=Tapo%20-%20New%20Order%20Inquiry&body=Hi%20Tapo%20Team,%0D%0A%0D%0AI%20would%20like%20to%20inquire%20about%20your%20food%20packaging%20products.%20Please%20provide%20me%20with%20more%20details.%0D%0A%0D%0AThank%20you."><i class="fa fa-envelope"></i></a>
                                            </div>
                                            <a href="javascript:void(0);" id="openPopup">
                                                <img src="assets/images/home/footer/biz.png" alt="Button Image" class="tml-button-img mt-4">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-6">
                                    <!-- Footer Widget -->
                                    <div class="footer-widget footer-nav-widget mb-4 pb-3" data-aos="fade-up" data-aos-duration="1000">
                                        <h4 class="widget-title mb-3 pb-2">Useful Link</h4>
                                        <div class="widget-content">
                                            <ul>
                                                <li><a href="#">About Us</a></li>
                                                <li><a href="#">Subscribe</a></li>
                                                <li><a href="#">Shop</a></li>
                                                <li><a href="#">Blog</a></li>
                                                <li><a href="#">Contact</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <!-- Footer Widget -->
                                    <div class="footer-widget footer-time-widget mb-4 pb-3" data-aos="fade-up" data-aos-duration="1200">
                                        <h4 class="widget-title mb-3 pb-2">Opening Time</h4>
                                        <div class="widget-content">
                                            <ul>
                                                <li><span class="days">Mon - Thu:</span><span class="time">10:00 am - 01:00 am</span></li>
                                                <li><span class="days">Fri - Sat:</span><span class="time">10:00 am - 01:00 am</span></li>
                                                <li><span class="days">Sunday:</span><span class="off-day">Off Day</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6">
                                    <!-- Footer Widget -->
                                    <div class="footer-widget footer-newsletter-widget mb-4 pb-3" data-aos="fade-up" data-aos-duration="1400">
                                        <h4 class="widget-title mb-3 pb-2">Our Newsletter</h4>
                                        <div class="widget-content">
                                            <p>Subscribe and receive free vouchers every month!</p>
                                            <form>
                                                <div class="form-group">
                                                    <input type="text" class="form_control" placeholder="Enter Email Address" name="name" required>
                                                    <button class="submit-btn">Subscribe<i class="far fa-paper-plane"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Copyright Area -->
                        <div class="copyright-area">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="copyright-text" data-aos="fade-right" data-aos-duration="1200">
                                        <p>&copy; 2025 All rights reserved by Brianiac Creation.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="copyright-link float-md-end" data-aos="fade-left" data-aos-duration="1400">
                                        <a href="#">Privacy Policy</a>
                                        <a href="#">Terms & Condition</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer><!--====== End Footer ======-->
