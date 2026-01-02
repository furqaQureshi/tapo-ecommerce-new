@extends('front.layouts.app')

@section('title')
    {{ __('lang.choose_products') }}
@endsection

@push('styles')
    <style>
        .category-tabs .nav-tabs {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            overflow-y: hidden;
            white-space: nowrap;
            border-bottom: none;
            scrollbar-width: thin;
            scrollbar-color: #e490a1 #fff;
        }

        .category-tabs .nav-item {
            flex: 0 0 auto;
        }

        .category-tabs .nav-link.active,
        .category-tabs .nav-link:focus {
            color: #fff !important;
            background-color: #e490a1 !important;
            border-color: #e490a1 !important;
        }

        .category-tabs .nav-link {
            color: #e490a1 !important;
            font-weight: 500;
            border-radius: 0px;
            font-size: 18px;
        }

        .tab-content .product-collection-item .product-image .badge-addon-price {
            font-size: 12px;
            font-weight: 600;
            color: var(--white);
            background-color: #f58c9d;
            width: 60px;
            height: 40px;
            line-height: 39px;
            text-align: center;
            border-radius: 50px;
            position: absolute;
            right: 25px;
            /* Position it from the right */
            top: 25px;
        }
    </style>
@endpush

@section('content')
    <div class="modal modal-common-wrap fade" id="exampleModal2" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="shop-details-wrapper">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="shop-details-image">
                                    <div class="tab-content">
                                        <div class="shop-thumb">
                                            <img id="modal-product-image" src="assets/img/product/01.jpg"
                                                alt="Product Image" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="product-details-content">
                                    <h3 id="modal-product-name" class="pb-3">Product Name</h3>
                                    {{-- <div class="star pb-3">
                                    <a href="#"><i class="fas fa-star"></i></a>
                                    <a href="#"><i class="fas fa-star"></i></a>
                                    <a href="#"><i class="fas fa-star"></i></a>
                                    <a href="#"><i class="fas fa-star"></i></a>
                                    <a href="#"><i class="fas fa-star"></i></a>
                                    <span>(25 Customer Review)</span>
                                </div> --}}
                                    <p id="modal-product-description" class="mb-3">
                                        No description available
                                    </p>
                                    <div class="price-list">
                                        <h3 id="modal-product-price">RM0.00</h3>
                                    </div>
                                    <div class="cart-wrp">
                                        <a href="product-details.html" class="icon">
                                            <i class="far fa-heart"></i>
                                        </a>
                                        <div class="social-profile">
                                            <span class="plus-btn"><i class="far fa-share"></i></span>
                                            <ul>
                                                <li>
                                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h6 class="details-info">
                                        <span>SKU:</span>
                                        <a id="modal-product-sku" href="product-details.html">N/A</a>
                                    </h6>
                                    <h6 class="details-info">
                                        <span>Categories:</span>
                                        <a id="modal-product-category" href="product-details.html">N/A</a>
                                    </h6>
                                    {{-- <h6 class="details-info style-2">
                                    <span>Tags:</span>
                                    <a id="modal-product-tags" href="product-details.html">N/A</a>
                                </h6> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="pages-banner-section">
        <div class="hero-2">
            <div class="hero-bg" style="background-image: url(front/assets/img/pages-bg.jpg)">
                <div class="hero-overlay"></div>
            </div>
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="section-title-area pbanner-content"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shop-left-sideber-section section-padding">
        <div class="container">
            <div class="product-details-wrapper row">
                <div class="col-lg-4 shop-products-grid choose-products-grid sidebar-steps">
                    <div class="step-indicator">
                        <!-- Step 1: Choose Products -->
                        <div class="step-navi step-1 active">1. Choose Products</div>
                        <div class="step-container step-1 active">
                            <div class="section-title-area">
                                <div class="section-title style-3">
                                    <p>
                                        Select any 2 items from our collection â€” and enjoy a free
                                        mystery gift added to your box!
                                    </p>
                                </div>
                            </div>
                            <div class="checkout-order-area">
                                <div class="product-checout-imgarea">
                                    <div class="checkout-image-item align-items-center justify-content-between">
                                        <p>Selected Items</p>
                                        <div class="selected-products"></div>
                                        <br>
                                        Value of Product(s):
                                        <span class="total-price"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="step-navigation">
                                <button class="theme-btn-step theme-btn next-btn" disabled>
                                    Next <i class="fa-regular fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Select Plan -->
                        <div class="step-navi step-2 disabled">2. Select Plan</div>
                        <div class="step-container step-2">
                            <div class="section-title-area">
                                <div class="section-title style-3">
                                    <p>
                                        Go with a Monthly or Yearly subscription â€” whatever suits
                                        you best.
                                    </p>
                                </div>
                            </div>
                            <div>
                                @foreach ($plans as $plan)
                                    @php
                                        $planType = $plan->type == 1 ? 'monthly' : 'yearly';
                                        $inputId = $planType . '-plan-' . $plan->id;
                                    @endphp

                                    <input type="radio" id="{{ $inputId }}" name="pricing-plan" class="pricing-radio"
                                        value="{{ $plan->price }}" data-type="{{ $plan->type }}"
                                        data-plan-id="{{ $plan->id }}" data-title="{{ $plan->title }}" />


                                    <label for="{{ $inputId }}" class="pricing-label">
                                        <input type="hidden" value="{{ $plan->id }}" name="plan_id">
                                        <div class="pricing-box">
                                            <div class="plan-details">
                                                <h4>{{ $plan->title }}</h4>
                                                <p class="savings">Save up to {{ $plan->discount }}% per month</p>
                                                <p class="price">
                                                    RM{{ $plan->price }} <span class="month">/ Month</span>
                                                </p>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                                {{-- <input type="radio" id="monthly-plan" name="pricing-plan" class="pricing-radio"
                                    value="79" />
                                <label for="monthly-plan" class="pricing-label">
                                    <div class="pricing-box">
                                        <div class="plan-details">
                                            <h4>Monthly Fee</h4>
                                            <p class="savings">Save up to 11% per month</p>
                                            <p class="price">
                                                RM79 <span class="month">/ Month</span>
                                            </p>
                                        </div>
                                    </div>
                                </label>
                                <input type="radio" id="yearly-plan" name="pricing-plan" class="pricing-radio"
                                    value="69" />
                                <label for="yearly-plan" class="pricing-label">
                                    <div class="pricing-box">
                                        <div class="plan-details">
                                            <h4>Yearly Fee</h4>
                                            <p class="savings">Save up to 22% per month</p>
                                            <p class="price">
                                                RM69 <span class="month">/ Month</span>
                                            </p>
                                        </div>
                                    </div>
                                </label> --}}
                                <div class="step-navigation">
                                    <button class="theme-btn-step theme-btn back-btn">
                                        <i class="fa-regular fa-arrow-left"></i> Back
                                    </button>
                                    <button class="theme-btn-step theme-btn next-btn" disabled>
                                        Next <i class="fa-regular fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Checkout -->
                        <div class="step-navi step-3 disabled">3. Checkout</div>
                        <div class="step-container step-3">
                            <div class="section-title-area">
                                <div class="section-title style-3">
                                    <p>
                                        Woohoo!!! ðŸŽ‰ Your Aprilâ€™s Package just got better with
                                        your mystery gift. Confirm your details and complete your
                                        order!
                                    </p>
                                </div>
                            </div>
                            <div class="checkout-order-area">
                                <div class="product-checout-area">
                                    <div class="checkout-item d-flex align-items-center justify-content-between">
                                        <p>Selected Plan</p>
                                        <p class="selected-plan"></p>
                                    </div>
                                    <div class="checkout-item d-flex align-items-center justify-content-between">
                                        <p>Add-on Price</p>
                                        <p class="addon-price"></p>
                                    </div>
                                    <div class="checkout-item d-flex align-items-center justify-content-between">
                                        <p>Renewal Date</p>
                                        <p class="renewal-date"></p>
                                    </div>
                                    <div class="checkout-item d-flex align-items-center justify-content-between d-none">
                                        <p>Total</p>
                                        <p class="total-price"></p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="step-navigation">
                                    <button class="theme-btn-step theme-btn back-btn">
                                        <i class="fa-regular fa-arrow-left"></i> Back
                                    </button>
                                    <a href="#" class="theme-btn-step theme-btn theme-btn-4 checkout-btn">Checkout
                                        <i class="fa-regular fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 shop-products-grid choose-products-grid">
                    <!-- Category Tabs Start -->
                    <div class="category-tabs mb-4">
                        <ul class="nav nav-tabs" id="productCategoryTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="all-tab" data-category="all" type="button"
                                    role="tab">
                                    All
                                </button>
                            </li>
                            @if (!empty($categories))
                                @foreach ($categories as $category)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="{{ $category->slug }}-tab"
                                            data-category="{{ $category->slug }}" type="button" role="tab">
                                            {{ $category->name }}
                                        </button>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <!-- Category Tabs End -->

                    <div class="tab-content">
                        <div class="row g-4">
                            @if (!empty($bundle))
                                @php
                                    $productsArray = $bundle->getProducts()->map(function($product) {
                                        $firstImage = $product->media->first();
                                        $imageSrc = $firstImage
                                            ? asset($firstImage->image_path)
                                            : ($product->featured_image
                                                ? asset($product->featured_image)
                                                : asset('assets/img/product/01.jpg'));

                                        $afterDiscount = $product->discount
                                            ? $product->price - ($product->price * $product->discount) / 100
                                            : $product->price;

                                        return [
                                            'id' => $product->id,
                                            'name' => $product->name,
                                            'price' => $afterDiscount,
                                            'image' => $imageSrc,
                                            'addonPrice' => $product->addon_price ?? 0,
                                        ];
                                    })->toArray();
                                @endphp
                                @foreach ($bundle->getProducts() as $product)
                                    <div class="col-xl-4 col-lg-4 col-md-6 ccol-product">
                                        <div class="product-collection-item" data-product-id="{{ $product->id }}"
                                            data-category="{{ $product->categories->pluck('slug')->implode(',') }}">
                                            <div class="product-image">
                                                @php
                                                    $firstImage = $product->media->first();
                                                    $imageSrc = $firstImage
                                                        ? asset($firstImage->image_path)
                                                        : ($product->featured_image
                                                            ? asset($product->featured_image)
                                                            : asset('assets/img/product/01.jpg'));
                                                @endphp
                                                <img src="{{ $imageSrc }}" alt="{{ $product->title }}" />
                                                @if ($product->label === 'zeera_pick')
                                                    <div class="badge badge-warning">Zeera Pick</div>
                                                @elseif ($product->label === 'addon' && $product->addon_price)
                                                    <div class="badge badge-danger">
                                                        +RM{{ number_format($product->addon_price, 2) }}</div>
                                                @endif
                                                <div class="shopc-checkbox">
                                                    <input type="checkbox" id="{{ $product->id }}-checkbox"
                                                        name="{{ $product->name }}" hidden />
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h4><a href="#">{{ $product->name }}</a></h4>
                                                <a href="#" class="product-details-link" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal2" data-product-id="{{ $product->id }}"
                                                    data-product-name="{{ $product->name }}"
                                                    data-product-price="{{ $product->discount ? $product->price - ($product->price * $product->discount) / 100 : $product->price }}"
                                                    data-product-image="{{ $imageSrc }}"
                                                    data-product-sku="{{ $product->sku ?? 'N/A' }}"
                                                    data-product-category="{{ $product->category->name ?? 'N/A' }}"
                                                    {{-- data-product-tags="{{ implode(',', $product->tags ?? ['accessories', 'business']) }}" --}}
                                                    data-product-description="{{ $product->short_description ?? 'No description available' }}">
                                                    <i class="fa-regular fa-eye"></i> Product Details
                                                </a>
                                                @php
                                                    $after_discount =
                                                        $product->price - ($product->price * $product->discount) / 100;
                                                @endphp
                                                {{-- @if(!empty($product->variants) && count($product->variants) > 0)
                                                    @foreach($product->variants as $index => $variant)
                                                        <div class="form-check">
                                                            <label class="form-check-label" for="price_{{ $variant->price }}">
                                                                <input class="form-check-input variant-radio" type="radio" name="variant_{{ $product->slug }}" value="{{ $variant->id }}" data-productid="{{ $product->id }}" data-variant-price="{{ $variant->price }}" id="price_{{ $variant->price }}">
                                                                {{ $variant->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                @endif --}}
                                                @if ($product->discount)
                                                    <ul class="doller">
                                                        <li>
                                                            RM {{ number_format($after_discount, 2) }}
                                                            @if ($product->discount)
                                                                <del>RM {{ number_format($product->price, 2) }}</del>
                                                            @endif
                                                        </li>
                                                    </ul>
                                                @else
                                                    <p><span class="pro-price-{{ $product->id }}">RM{{ number_format($product->price, 2) }}</span></p>
                                                @endif
                                                @if($product->qty > 0 )
                                                    <button class="shopc-button" data-product-id="{{ $product->id }}"
                                                        data-price="{{ $product->discount ? $after_discount : $product->price }}"
                                                        data-addon-price="{{ $product->addon_price ?? 0 }}"
                                                        data-selected="false"
                                                        data-variant-id="">
                                                        <span class="icon">+</span> Add this
                                                    </button>
                                                @else
                                                    <button class="out-of-stock-btn disabled-link"> Out of Stock</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div class="col-12 shop-products-grid choose-products-grid sidebar-steps sidebar-steps-mob">
      <div class="step-indicator">
        <!-- Step 1: Choose Products -->
        <div class="step-container step-1 active">
          <div class="section-title-area">
            <div class="section-title style-3">
              <p>
                Select any 3 items from our collection — and enjoy a free
                mystery gift added to your box!
              </p>
            </div>
          </div>
          <div class="checkout-order-area">
            <div class="product-checout-imgarea">
              <div class="checkout-image-item align-items-center justify-content-between">
                <p>Selected Items</p>
                <div class="selected-products"></div>
                <br>
                Value of Product(s):
                <span class="total-price"></span>
              </div>
            </div>
          </div>
          <div class="step-navigation">
            <button class="theme-btn-step theme-btn next-btn" disabled>
              Next <i class="fa-regular fa-arrow-right"></i>
            </button>
          </div>
        </div>
    
        <!-- Step 2: Select Plan -->
        <div class="step-container step-2">
          <div class="section-title-area">
            <div class="section-title style-3">
              <p>
                Go with a Monthly or Yearly subscription — whatever suits
                you best.
              </p>
            </div>
          </div>
          <div>
            @foreach ($plans as $plan)
              @php
                $planType = $plan->type == 1 ? 'monthly' : 'yearly';
                $inputId = $planType . '-plan-' . $plan->id;
              @endphp
              <input type="radio" id="{{ $inputId }}" name="pricing-plan" class="pricing-radio"
                value="{{ $plan->price }}" data-type="{{ $plan->type }}"
                data-plan-id="{{ $plan->id }}" data-title="{{ $plan->title }}" />
              <label for="{{ $inputId }}" class="pricing-label">
                <input type="hidden" value="{{ $plan->id }}" name="plan_id">
                <div class="pricing-box">
                  <div class="plan-details">
                    <h4>{{ $plan->title }}</h4>
                    <p class="savings">Save up to {{ $plan->discount }}% per month</p>
                    <p class="price">
                      RM{{ $plan->price }} <span class="month">/ Month</span>
                    </p>
                  </div>
                </div>
              </label>
            @endforeach
            <div class="step-navigation">
              <button class="theme-btn-step theme-btn back-btn">
                <i class="fa-regular fa-arrow-left"></i> Back
              </button>
              <button class="theme-btn-step theme-btn next-btn" disabled>
                Next <i class="fa-regular fa-arrow-right"></i>
              </button>
            </div>
          </>
        </div>
    
        <!-- Step 3: Checkout -->
        <div class="step-container step-3">
          <div class="section-title-area">
            <div class="section-title style-3">
              <p>
                Woohoo!!! 🎉 Your April’s Package just got better with
                your mystery gift. Confirm your details and complete your
                order!
              </p>
            </div>
          </div>
          <div class="checkout-order-area">
            <div class="product-checout-area">
              <div class="checkout-item d-flex align-items-center justify-content-between">
                <p>Selected Plan</p>
                <p class="selected-plan"></p>
              </div>
              <div class="checkout-item d-flex align-items-center justify-content-between">
                <p>Add-on Price</p>
                <p class="addon-price"></p>
              </div>
              <div class="checkout-item d-flex align-items-center justify-content-between">
                <p>Renewal Date</p>
                <p class="renewal-date"></p>
              </div>
              <div class="checkout-item d-flex align-items-center justify-content-between d-none">
                <p>Total</p>
                <p class="total-price"></p>
              </div>
            </div>
          </div>
          <div class="step-navigation">
            <button class="theme-btn-step theme-btn back-btn">
              <i class="fa-regular fa-arrow-left"></i> Back
            </button>
            <a href="#" class="theme-btn-step theme-btn theme-btn-4 checkout-btn">
              Checkout <i class="fa-regular fa-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <style>
        .product-image {
            position: relative;
        }

        .badge {
            position: absolute;
            top: 6px;
            padding: 7px 10px;
            font-size: 16px;
            font-weight: 500;
            color: white;
            border-radius: 4px;
        }

        .badge-discount {
            left: 10px;
            background-color: #28a745;
            /* Green for discount */
        }

        .badge-warning {
            right: 10px;
            background-color: #ffc107;
            /* Bootstrap warning color */
        }

        .badge-danger {
            right: 10px;
            background-color: #dc3545;
            /* Bootstrap danger color */
        }
    </style>
@endsection

@push('scripts')
    <script>
        window.bundleProducts = @json($productsArray);
    </script>
    
    <script>
    // Function to filter content based on category
        function filterContent(category) {
          console.log('Filtering for category:', category); // Debugging
          const contentItems = document.querySelectorAll('.content-item');
          
          contentItems.forEach(item => {
            const categories = item.getAttribute('data-category').split(' ');
            if (category === 'all' || categories.includes(category)) {
              item.style.display = 'block';
            } else {
              item.style.display = 'none';
            }
          });
    
          // Update active tab (for desktop)
          document.querySelectorAll('.nav-link').forEach(tab => {
            tab.classList.remove('active');
            if (tab.getAttribute('data-category') === category) {
              tab.classList.add('active');
            }
          });
        }
    
        // Handle dropdown change
        document.getElementById('categorySelect').addEventListener('change', function () {
          const selectedCategory = this.value;
          console.log('Dropdown changed to:', selectedCategory); // Debugging
          filterContent(selectedCategory);
        });
    
        // Handle tab clicks (for desktop)
        document.querySelectorAll('.nav-link').forEach(tab => {
          tab.addEventListener('click', function () {
            const category = this.getAttribute('data-category');
            console.log('Tab clicked:', category); // Debugging
            filterContent(category);
            document.getElementById('categorySelect').value = category;
          });
        });
    
        // Initialize with default category
        filterContent('all');
      </script>
    
    
    {{-- <script>
        $(document).on('change', '.variant-radio', function() {
            var variantPrice = $(this).data('variant-price');
            var variantProductId = $(this).val();
            var $button = $('.shopc-button');
            var proId = $(this).data('productid');

            $('.pro-price-'+proId).text('RM'+variantPrice)

            $button.attr('data-price', variantPrice);
            $button.attr('data-variant-id', variantProductId);
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            const $tabs = $(".category-tabs .nav-link");
            const $productContainers = $(".ccol-product");

            function showCategory(category) {
                $productContainers.each(function() {
                    const $productItem = $(this).find(".product-collection-item");
                    const itemCategories = $productItem.data("category").split(",");
                    if (category === "all" || itemCategories.includes(category)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            $tabs.on("click", function() {
                $tabs.removeClass("active");
                $(this).addClass("active");
                showCategory($(this).data("category"));
            });

            showCategory("all");
        });
    </script>
    <script>
        $(document).ready(function() {

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
                    title: 'Are you sure?',
                    text: 'Do you want to remove this item from the cart?',
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

            // Function to update cart sidebar content
            // function updateCartSidebar(cartItems, totalPrice) {
            //     var $cartList = $('.menu-cart.style-2 .cart-box ul');
            //     var $cartTotal = $('.totalPrice');
            //     $cartList.empty(); // Clear current cart items

            //     if (cartItems.length > 0) {
            //         // Group items by product_id to prevent duplicates
            //         var groupedItems = {};
            //         var localTotalPrice = 0;

            //         $.each(cartItems, function(index, item) {
            //             var productId = item.product_id || item.id; // Handle different response formats
            //             if (!groupedItems[productId]) {
            //                 groupedItems[productId] = {
            //                     ...item,
            //                     quantity: 0
            //                 };
            //             }
            //             groupedItems[productId].quantity += parseInt(item.quantity, 10);
            //             localTotalPrice += parseFloat(item.price) * parseInt(item.quantity, 10);
            //         });

            //         // Render grouped items
            //         $.each(groupedItems, function(productId, item) {
            //             var photo = item.image ?
            //                 (item.image.includes(',') ?
            //                     window.baseURL + '/' + item.image.split(',')[0].trim() :
            //                     window.baseURL + '/' + item.image) :
            //                 window.baseURL + '/front/assets/img/product/01.jpg';

            //             var cartItemHtml = `
            //     <li data-product-id="${item.id}" data-is-model="0">
            //         <a href="javascript:void(0);" class="remove remove-cart-item" title="Remove this item">
            //             <i class="fa fa-remove"></i>
            //         </a>
            //         <img src="${photo}" alt="${item.name}" />
            //         <div class="cart-product">
            //             <a href="{{ route('product.detail', '') }}/${item.slug}" target="_blank">
            //                 ${item.name}
            //             </a>
            //             <span>RM ${parseFloat(item.price).toFixed(2)}</span>
            //             <p class="quantity">${item.quantity} x</p>
            //         </div>
            //     </li>`;
            //             $cartList.append(cartItemHtml);
            //         });

            //         // Update total price
            //         $cartTotal.text(`RM ${parseFloat(totalPrice).toFixed(2)}`);

            //         // Show cart buttons
            //         $('.menu-cart.style-2 .cart-box .cart-button').show();
            //     } else {
            //         $cartList.append('<li>No items in cart.</li>');
            //         $cartTotal.text(`RM 0.00`);
            //         $('.menu-cart.style-2 .cart-box .cart-button').hide();
            //     }
            // }

            // Function to update cart icon count
            function updateCartCount(count) {
                var $cartIconCount = $('.menu-cart.style-2 .cart-icon .total-count');
                if (count > 0) {
                    $cartIconCount.text(count).show();
                } else {
                    $cartIconCount.hide();
                }
            }

            // Handle remove item from cart


            // Existing cart sidebar toggle logic
            var $menuCart = $(".menu-cart.style-2");
            var $cartBox = $menuCart.find(".cart-box");
            var $cartIcon = $menuCart.find(".cart-icon");

            $cartBox.hide();

            // Toggle on cart icon click
            $cartIcon.on("click", function(e) {
                e.preventDefault();
                $cartBox.toggle();
            });

            // Hide cart when clicking outside
            $(document).on("click", function(e) {
                if (!$menuCart.is(e.target) && $menuCart.has(e.target).length === 0) {
                    $cartBox.hide();
                }
            });

            // Close button inside header
            var $closeHeader = $("#cartCloseHeader");
            if ($closeHeader.length) {
                $closeHeader.on("click", function() {
                    $closeHeader.closest(".cart-box").hide();
                });
            }

            // Also close on outside mousedown
            $(document).on("mousedown", function(e) {
                if ($cartBox.is(":visible") && !$cartBox.is(e.target) && $cartBox.has(e.target).length ===
                    0) {
                    $cartBox.hide();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.product-details-link').on('click', function(e) {
                e.preventDefault(); // Prevent default link behavior

                // Get product data from data attributes
                const productName = $(this).data('product-name');
                const productPrice = parseFloat($(this).data('product-price')).toFixed(2);
                const productImage = $(this).data('product-image');
                const productDescription = $(this).data('product-description');
                const productSku = $(this).data('product-sku');
                const productCategory = $(this).data('product-category');
                const productTags = $(this).data('product-tags');

                // Update modal content
                $('#modal-product-name').text(productName);
                $('#modal-product-price').text(`RM${productPrice}`);
                $('#modal-product-image').attr('src', productImage).attr('alt', productName);
                $('#modal-product-description').text(productDescription);
                $('#modal-product-sku').text(productSku);
                $('#modal-product-category').text(productCategory);
                $('#modal-product-tags').text(productTags);
            });
        });
    </script>
@endpush
