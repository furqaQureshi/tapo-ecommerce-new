  <!-- footer-section Start -->
  <footer class="footer-section footer-bg-2 fix">
      <div class="container">
          <div class="footer-widget-wrapper style-2">
              <div class="row">
                  <div class="col-xl-3 col-lg-4 col-md-4 wow fadeInUp" data-wow-delay=".2s">
                      <div class="single-footer-widget">
                          <div class="widget-head">
                              <a href="#" class="footer-logo">
                                  <img src="{{ asset('front/assets/img/logo/logo.png') }}" alt="logo-img">
                              </a>
                          </div>
                          <div class="footer-content">
                              <div class="social-item">
                                  <div class="social-icon d-flex align-items-center">
                                      @php
                                          $iconMap = [
                                              'Facebook' => 'fab fa-facebook-f',
                                              'Twitter' => 'fab fa-twitter',
                                              'Instagram' => 'fab fa-instagram',
                                              'Youtube' => 'fab fa-youtube',
                                              'WhatsApp' => 'fab fa-whatsapp',
                                          ];
                                      @endphp
                                      @foreach ($followUsFooterSections['Follow Us'] ?? [] as $item)
                                          <a href="{{ $item->link_url }}" target="_blank" rel="noopener">
                                              <i class="{{ $iconMap[$item->link_text] ?? 'fas fa-globe' }}"></i>
                                          </a>
                                      @endforeach
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
                      © {{ date('Y') }} ZERA POSTPARTUM PLT 202004003510 (LLP0026295-LGN). All Rights Reserved.
                  </p>
              </div>
          </div>
      </div>
  </footer>
