@extends('front.layouts.app')
@section('title')
    {{ $product->name }} | {{ __('lang.Detail') }}
@endsection
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">
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
        }

        .badge-warning {
            right: 10px;
            background-color: #ffc107;
        }

        .badge-danger {
            right: 10px;
            background-color: #dc3545;
        }

        .shop-details-image .tab-content .shop-thumb img {
            width: 100%;
            height: auto;
            max-height: 400px;
            object-fit: contain;
            border-radius: 8px;
        }

        .shop-details-image .nav .nav-link {
            padding: 5px;
            margin: 0 5px;
        }

        .shop-details-image .nav .nav-link img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border: 2px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s;
        }

        .shop-details-image .nav .nav-link.active img {
            border-color: #28a745;
        }


        input:disabled {
            background-color: #e0e0e0;
            color: #888;
            cursor: not-allowed;
            border: 1px solid #ccc;
            opacity: 0.6;
        }
    </style>

    <!-- Shop Details Section Start -->
    <section class="shop-details-section section-padding fix shop-bg">
        <div class="container">
            <div class="shop-details-wrapper">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="shop-details-image">
                            <div class="tab-content">
                                @php
                                    $media = $product->media;
                                    $hasImages = $media->isNotEmpty();
                                @endphp
                                @if ($hasImages)
                                    @foreach ($media as $index => $image)
                                        <div id="thumb{{ $index + 1 }}"
                                            class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}">
                                            <div class="shop-thumb">
                                                <a href="{{ asset($image->image_path) }}" data-fancybox="gallery">
                                                    <img src="{{ asset($image->image_path) }}" alt="{{ $product->name }}">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div id="thumb1" class="tab-pane fade show active">
                                        <div class="shop-thumb">
                                            <a href="{{ asset('front/assets/img/product/01.jpg') }}"
                                                data-fancybox="gallery">
                                                <img src="{{ asset('front/assets/img/product/01.jpg') }}"
                                                    alt="{{ $product->name }}">
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if ($hasImages)
                                <ul class="nav">
                                    @foreach ($media as $index => $image)
                                        <li class="nav-item">
                                            <a href="#thumb{{ $index + 1 }}" data-bs-toggle="tab"
                                                class="nav-link {{ $index === 0 ? 'active' : '' }}">
                                                <img src="{{ asset($image->image_path) }}" alt="{{ $product->name }}">
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-details-content">
                            <h3 class="pb-3">{{ $product->name }}</h3>
                            <div class="star pb-3">
                                <a href="#"><i class="fas fa-star"></i></a>
                                <a href="#"><i class="fas fa-star"></i></a>
                                <a href="#"><i class="fas fa-star"></i></a>
                                <a href="#"><i class="fas fa-star"></i></a>
                                <a href="#"><i class="fas fa-star"></i></a>
                                <span>({{ count($product->review) }} {{ __('lang.Customer_Review') }})</span>
                            </div>
                            <p class="mb-3">
                                {{ $product->short_description }}
                            </p>
                            <div class="price-list">
                                @if (!empty($product->variants) && count($product->variants) > 0)
                                    <!--<h3>{{ __('lang.Select_Product') }}</h3>-->
                                    <!--<div class="row variantRow mt-2">-->
                                    <!--    @foreach ($product->variants as $index => $variant)
    -->
                                    <!--        <div class="col-6 col-md-6 card-container">-->
                                    <!--            <div class="pricing-card" data-id="{{ $variant->id }}"-->
                                    <!--                data-name="{{ $variant->name }}" data-sku="{{ $variant->sku }}"-->
                                    <!--                data-price="{{ calculatedPrice($variant->price) }}"-->
                                    <!--                data-var-qty="{{ $variant->variant_qty }}"-->
                                    <!--                data-product-id="{{ $variant->product_id }}">-->

                                    <!--                <div class="lattice-count">{{ $variant->name }}</div>-->
                                    <!--                <div>{{ $variant->variant_qty }} {{ __('lang.In_stock') }}</div>-->
                                    <!--                <div class="price">{{ config('app.currency') }}-->
                                    <!--                    {{ calculatedPrice($variant->price) }}</div>-->
                                    <!--            </div>-->
                                    <!--        </div>-->
                                    <!--
    @endforeach-->
                                    <!--</div>-->
                                @endif
                                <div class="product-options-container">
                                    @if (!empty($product->attributes) && count($product->attributes) > 0)
                                        <div class="options-card">
                                            <h2 class="options-title">{{ __('lang.ProductOptions') }}</h2>
                                            <div class="options-list">
                                                @php
                                                    $processedAttributes = [];
                                                @endphp
                                                @foreach ($product->attributes as $productAttribute)
                                                    @php
                                                        $attribute = \App\Models\Attribute::find($productAttribute->attribute_id);
                                                    @endphp
                                                    @if ($attribute && $attribute->status == 1 && !in_array($productAttribute->attribute_id, $processedAttributes))
                                                        <div class="attribute-group">
                                                            <label class="attribute-label">
                                                                {{ $attribute->name }}
                                                            </label>
                                                            <div class="badge-container">
                                                                @foreach ($product->attributes as $innerAttribute)
                                                                    @if ($innerAttribute->attribute_id === $productAttribute->attribute_id)
                                                                        @php
                                                                            $values = explode(
                                                                                ',',
                                                                                $innerAttribute->attribute_value,
                                                                            );
                                                                        @endphp
                                                                        @foreach ($values as $value)
                                                                            <button class="attribute-badge"
                                                                                data-value="{{ trim($value) }}"
                                                                                data-id="{{ $innerAttribute->id }}">
                                                                                {{ ucfirst(trim($value)) }}
                                                                            </button>
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        @php
                                                            $processedAttributes[] = $productAttribute->attribute_id;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <p class="no-options">{{ __('lang.No_attributes_available_for_this_product') }}</p>
                                    @endif
                                </div>

                                <style>
                                    .product-options-container {
                                        max-width: 800px;
                                        margin: 24px auto;
                                        background: #fff9f9;
                                    }

                                    .options-card {
                                        background: #ffffff;
                                        border-radius: 8px;
                                        padding: 16px;
                                    }

                                    .options-title {
                                        font-size: 20px;
                                        font-weight: 600;
                                        color: #1f2937;
                                        margin-bottom: 12px;
                                    }

                                    .options-list {
                                        display: flex;
                                        flex-direction: column;
                                        gap: 12px;
                                    }

                                    .attribute-group {
                                        display: flex;
                                        flex-direction: column;
                                    }

                                    .attribute-label {
                                        font-size: 16px;
                                        font-weight: 500;
                                        color: #374151;
                                        margin-bottom: 8px;
                                    }

                                    .badge-container {
                                        display: flex;
                                        gap: 8px;
                                        flex-wrap: wrap;
                                        justify-content: flex-start;
                                    }

                                    .attribute-badge {
                                        padding: 8px 16px;
                                        background: #f3f4f6;
                                        color: #1f2937;
                                        border-radius: 8px;
                                        border: 1px solid #e5e7eb;
                                        font-size: 14px;
                                        font-weight: 500;
                                        cursor: pointer;
                                        transition: all 0.2s ease;
                                        position: relative;
                                        min-width: 80px;
                                        text-align: center;
                                    }

                                    .attribute-badge[data-value="red"] {
                                        background: #fee2e2;
                                        color: #f58c9d;
                                        border-color: #fecaca;
                                    }

                                    .attribute-badge[data-value="blue"] {
                                        background: #dbeafe;
                                        color: #1e40af;
                                        border-color: #bfdbfe;
                                    }

                                    .attribute-badge[data-value="black"] {
                                        background: #e5e7eb;
                                        color: #1f2937;
                                        border-color: #d1d5db;
                                    }

                                    .attribute-badge:hover {
                                        transform: translateY(-1px);
                                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                                    }

                                    .attribute-badge.active {
                                        background: #f3f4f6;
                                        color: #f58c9d;
                                        border: 2px solid #f58c9d;
                                        position: relative;
                                    }

                                    .attribute-badge.active::after {
                                        content: '•';
                                        color: #f58c9d;
                                        position: absolute;
                                        top: 50%;
                                        right: -6px;
                                        transform: translateY(-50%);
                                        font-size: 16px;
                                        background: #fff9f9;
                                        border-radius: 50%;
                                        width: 12px;
                                        height: 12px;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                    }

                                    .no-options {
                                        color: #6b7280;
                                        text-align: center;
                                        font-size: 16px;
                                    }
                                </style>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const buttons = document.querySelectorAll('.attribute-badge');

                                        buttons.forEach(button => {
                                            button.addEventListener('click', function() {
                                                buttons.forEach(btn => btn.classList.remove('active'));
                                                this.classList.add('active');
                                            });
                                        });
                                    });
                                </script>

                                @php
                                    $priceData =
                                        auth()->check() && auth()->user()->account_type === 'reseller'
                                            ? product_price_range($product)
                                            : normal_product_price_range($product);
                                    $afterDiscount =
                                        $product->price - ($product->price * ($product->discount ?? 0)) / 100;
                                    if (auth()->check() && auth()->user()->account_type === 'reseller') {
                                        $afterDiscount = round($afterDiscount * 0.99, 2);
                                    }
                                @endphp
                                <input type="hidden" name="product_id" class="product-id" value="{{ $product->id }}">
                                <input type="hidden" name="price" class="price" value="{{ $afterDiscount }}">
                                <h3 id="product_price">{{ $priceData['formatted_price'] }}
                                    @if ($priceData['original_price'])
                                        <del>{{ $priceData['original_price'] }}</del>
                                    @endif
                                </h3>
                                @if ($product->points > 0)
                                    <p>{{ __('lang.Buy_this_product_now_and_earn') }} <b>{{ $product->points }}</b>
                                        {{ __('lang.Points') }}</p>
                                @endif

                                @if ($priceData['discount_percentage'] > 0)
                                    <div class="badge badge-discount">{{ $priceData['discount_percentage'] }}%</div>
                                @endif
                            </div>
                            <div class="cart-wrp">
                                <div class="cart-quantity">
                                    <form id='myform' method='POST' class='quantity' action='#'>
                                        <input type='button' value='-' class='qtyminus minus'
                                            {{ $product->qty == 0 ? 'disabled' : '' }}>
                                        <input type='number' name='quantity' value='1' class='qty'
                                            {{ $product->qty == 0 ? 'disabled' : '' }}>
                                        <input type='button' value='+' class='qtyplus plus'
                                            {{ $product->qty == 0 ? 'disabled' : '' }}>
                                    </form>
                                </div>
                                <a href="javascript:void(0);" class="icon">
                                    <i class="far fa-heart"></i>
                                </a>
                                <div class="social-profile">
                                    <span class="plus-btn"><i class="far fa-share"></i></span>
                                    <ul>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                                <p>{{ __('lang.stock') }} <b>{{ $product->qty }}</b> {{ __('lang.available') }}</p>
                            </div>
                            <div class="shop-btn">
                                @if ($product->qty > 0)
                                    <a href="javascript:void(0);" class="custom-rdxbtnr add-to-cart-btn"
                                        data-product-id="{{ $product->id }}" data-stock="{{ $product->qty }}"
                                        data-price="{{ $afterDiscount }}" id="addToCartBtn">
                                        <span>{{ __('lang.Add_to_cart') }}</span>
                                        <img src="{{ asset('front/assets/img/extra-dis.png') }}" alt="img" />
                                    </a>
                                @else
                                    <a href="javascript:void(0);" class="custom-rdxbtnr disabled-link">
                                        <span>{{ __('lang.out_of_stock') }}</span>
                                        <img src="{{ asset('front/assets/img/shape-1.png') }}" alt="img" />
                                    </a>
                                @endif
                            </div>
                            @if ($product->is_affiliate)
                                <p class="text-center">{{ __('lang.or') }}</p>
                                <p>{{ __('lang.Purchase_from') }}</p>
                                <div class="shop-btn-2">
                                    @if (!empty($product->affiliates))
                                        @foreach ($product->affiliates as $affiliate)
                                            <a href="{{ $affiliate->link }}"
                                                class="theme-btn shopee-btn"><span>{{ $affiliate->title }}</span></a>
                                        @endforeach
                                    @endif
                                </div>
                            @endif
                            <h6 class="details-info"><span>{{ __('lang.Categories') }}:</span>
                                @if ($product->categories && $product->categories->count())
                                    @foreach ($product->categories as $category)
                                        <a
                                            href="{{ route('front.category', ['unique_id' => $category->unique_id, 'slug' => $category->slug]) }}">
                                            {{ $category->name }}
                                        </a>
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                @else
                                    N/A
                                @endif
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Single-tab Section Start -->
    <section class="single-tab-section section-padding fix pt-0">
        <div class="container">
            <div class="single-tab">
                <ul class="nav mb-5">
                    <li class="nav-item">
                        <a href="#description" data-bs-toggle="tab" class="nav-link ps-0 active">
                            <h6>{{ __('lang.Description') }}</h6>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#review" data-bs-toggle="tab" class="nav-link">
                            <h6>{{ __('lang.reviews') }} ({{ count($product->review) }})</h6>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="description" class="tab-pane fade show active">
                        <div class="description-items">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12">
                                    <div class="description-content">
                                        <h3>{{ __('lang.Product_descriptions') }}</h3>
                                        <p class="mb-4">
                                            {!! $product->description !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Updated review section with purchase verification -->
                    <div id="review" class="tab-pane fade">
                        <div class="review-items">
                            @if ($reviews->count() > 0)
                                @foreach ($reviews as $review)
                                    <div class="admin-items d-flex flex-wrap flex-md-nowrap align-items-center pb-1">
                                        <div class="admin-img pb-2 pb-md-0 me-1">
                                            <img src="{{ asset($review->user->avatar) ?? asset('front/assets/img/testimonial/avatar-1.jpg') }}"
                                                alt="{{ $review->user->name }}">
                                        </div>
                                        <div class="content p-2">
                                            <div class="head-content pb-1 d-flex flex-wrap justify-content-between">
                                                <h5>{{ $review->user->name }}<span>{{ $review->created_at->format('d M Y \a\t h:i A') }}</span>
                                                </h5>
                                                <div class="star">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i
                                                            class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                            <p>{{ $review->remarks }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>{{ __('lang.no_reviews_yet') }}</p>
                            @endif

                            @if (auth()->check())
                                @php
                                    $hasPurchased = App\Models\Order::where('user_id', auth()->id())
                                        ->where('status', 'completed')
                                        ->whereHas('items', function ($query) use ($product) {
                                            $query->where('product_id', $product->id);
                                        })
                                        ->exists();
                                @endphp

                                @if ($hasPurchased)
                                    <div class="review-title mt-5 py-15 mb-30">
                                        <h4>{{ __('lang.add_a_review') }}</h4>
                                        <div class="rate-now d-flex align-items-center">
                                            <p>{{ __('lang.Rate_this_product') }}</p>
                                            <div class="star rating-stars" data-rating="0">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star text-muted"
                                                        data-value="{{ $i }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review-form">
                                        <form action="{{ route('reviews.store') }}" id="review-form" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="rating" id="rating-input" value="0">
                                            <div class="row g-4">
                                                <div class="col-lg-12 wow fadeInUp" data-wow-delay=".8">
                                                    <div class="form-clt-big form-clt">
                                                        <textarea name="remarks" id="remarks" placeholder="Write your review" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".9">
                                                    <button type="submit" class="theme-btn hover-color">
                                                        {{ __('lang.post_Submit') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <div class="review-title mt-5 py-15 mb-30">
                                        <p class="text-danger">{{ __('lang.purchase_required_to_review') }}</p>
                                    </div>
                                @endif
                            @else
                                <div class="review-title mt-5 py-15 mb-30">
                                    <p>{{ __('lang.please_login_to_review') }} <a
                                            href="{{ route('login') }}">{{ __('lang.login') }}</a></p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product-collection Section Start -->
    <section class="product-collection-section-2 section-padding pt-0 fix">
        <div class="container">
            <div class="section-title style-2 text-center">
                <h6 class="sub-title wow fadeInUp">
                    {{ __('lang.Next_day_Products') }}
                </h6>
                <h2 class="wow fadeInUp" data-wow-delay=".3s">
                    {{ __('lang.Related_Products') }}
                </h2>
            </div>
            <div class="tab-content">
                <div class="row">
                    @foreach ($relatedProducts as $relatedProduct)
                        @php
                            $priceData =
                                auth()->check() && auth()->user()->account_type === 'reseller'
                                    ? product_price_range($relatedProduct)
                                    : normal_product_price_range($relatedProduct);
                            $firstImage = $relatedProduct->media->first();
                            $imageSrc = $firstImage
                                ? asset($firstImage->image_path)
                                : ($relatedProduct->featured_image
                                    ? asset($relatedProduct->featured_image)
                                    : asset('assets/img/product/01.jpg'));
                        @endphp
                        <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                            <a href="{{ route('product.detail', $relatedProduct->slug) }}">
                                <div class="product-collection-item d-flex">
                                    <div class="product-image image-height me-2">
                                        <img src="{{ $imageSrc }}" alt="{{ $relatedProduct->name }}">
                                        @if ($priceData['discount_percentage'] > 0)
                                            <div class="badge">{{ $priceData['discount_percentage'] }}%</div>
                                        @endif
                                    </div>
                                    <div class="product-content text-center d-flex align-items-center flex-column">
                                        <h4 class="mb-auto font-16px">
                                            {{ $relatedProduct->name }}
                                        </h4>
                                        <p class="product-reviews"><span class="product-stars">★★★★★</span> 0
                                            {{ __('lang.reviews') }}</p>
                                        <ul class="doller">
                                            <li>
                                                {{ $priceData['formatted_price'] }}
                                                @if ($priceData['original_price'])
                                                    <del>{{ $priceData['original_price'] }}</del>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        var productStock = {{ $product->qty }};
        var selectedPrice = {{ $afterDiscount }};
    </script>
    <script>
        $(document).ready(function() {
            // Star rating functionality
            $('.rating-stars .fa-star').on('click', function() {
                let rating = $(this).data('value');
                $('#rating-input').val(rating);

                // Reset all stars
                $('.rating-stars .fa-star').each(function() {
                    $(this).removeClass('text-warning').addClass('text-muted');
                });

                // Highlight selected stars
                $('.rating-stars .fa-star').each(function() {
                    if ($(this).data('value') <= rating) {
                        $(this).removeClass('text-muted').addClass('text-warning');
                    }
                });
            });

            // Form submission
            $('#review-form').on('submit', function(e) {
                let rating = $('#rating-input').val();
                if (rating == 0) {
                    e.preventDefault();
                    toastr.error('{{ __('lang.Please_select_a_star_rating') }}');
                    return false;
                }
            });

            // Handle quantity buttons with namespacing to isolate to this page
            let isProcessing = false; // Debounce flag to prevent multiple rapid clicks

            // Remove any existing handlers and use namespaced events
            // $('.qtyplus').off('click.quantity').on('click.quantity', function(e) {
            //     e.preventDefault();
            //     e.stopPropagation(); // Prevent event bubbling
            //     if (isProcessing) return; // Skip if already processing
            //     isProcessing = true;

            //     let $qtyInput = $(this).closest('.quantity').find('.qty');
            //     let qty = parseInt($qtyInput.val()) || 1;
            //     $qtyInput.val(qty + 1);
            //     updatePriceDisplay({{ $afterDiscount }}, qty + 1);

            //     setTimeout(() => {
            //         isProcessing = false;
            //     }, 200); // Reset debounce after 200ms
            // });

            // $('.qtyminus').off('click.quantity').on('click.quantity', function(e) {
            //     e.preventDefault();
            //     e.stopPropagation(); // Prevent event bubbling
            //     if (isProcessing) return; // Skip if already processing
            //     isProcessing = true;

            //     let $qtyInput = $(this).closest('.quantity').find('.qty');
            //     let qty = parseInt($qtyInput.val()) || 1;
            //     if (qty > 1) {
            //         $qtyInput.val(qty - 1);
            //         updatePriceDisplay({{ $afterDiscount }}, qty - 1);
            //     }

            //     setTimeout(() => {
            //         isProcessing = false;
            //     }, 200); // Reset debounce after 200ms
            // });

            // $('.qty').off('input.quantity').on('input.quantity', function() {
            //     let qty = parseInt($(this).val()) || 1;
            //     if (qty < 1) {
            //         qty = 1;
            //         $(this).val(1);
            //     }
            //     updatePriceDisplay({{ $afterDiscount }}, qty);
            // });

            // function updatePriceDisplay(price, quantity) {
            //     let total = (price * quantity).toFixed(2);
            //     $('#product_price').html(
            //         `{{ config('app.currency') }} ${total} @if ($priceData['original_price']) <del>{{ $priceData['original_price'] }}</del> @endif`
            //     );
            // }
            // $('.qtyplus').off('click.quantity').on('click.quantity', function(e) {
            //     e.preventDefault();
            //     e.stopPropagation();
            //     if (isProcessing) return;
            //     isProcessing = true;

            //     let $qtyInput = $(this).closest('.quantity').find('.qty');
            //     let qty = parseInt($qtyInput.val()) || 1;

            //     if (qty < productStock) {
            //         qty += 1;
            //         $qtyInput.val(qty);
            //         updatePriceDisplay({{ $afterDiscount }}, qty);
            //     } else {
            //         toastr.warning(`Maximum stock limit reached (${productStock})`);
            //     }

            //     setTimeout(() => {
            //         isProcessing = false;
            //     }, 200);
            // });

            // $('.qtyminus').off('click.quantity').on('click.quantity', function(e) {
            //     e.preventDefault();
            //     e.stopPropagation();
            //     if (isProcessing) return;
            //     isProcessing = true;

            //     let $qtyInput = $(this).closest('.quantity').find('.qty');
            //     let qty = parseInt($qtyInput.val()) || 1;

            //     if (qty > 1) {
            //         qty -= 1;
            //         $qtyInput.val(qty);
            //         updatePriceDisplay({{ $afterDiscount }}, qty);
            //     }

            //     setTimeout(() => {
            //         isProcessing = false;
            //     }, 200);
            // });

            // $('.qty').off('input.quantity').on('input.quantity', function() {
            //     let qty = parseInt($(this).val()) || 1;

            //     if (qty < 1) {
            //         qty = 1;
            //     } else if (qty > productStock) {
            //         qty = productStock;
            //         toastr.warning(`Maximum stock limit is ${productStock}`);
            //     }

            //     $(this).val(qty);
            //     updatePriceDisplay({{ $afterDiscount }}, qty);
            // });

            // function updatePriceDisplay(price, quantity) {
            //     let total = (price * quantity).toFixed(2);
            //     $('#product_price').html(
            //         `{{ config('app.currency') }} ${total} @if ($priceData['original_price']) <del>{{ $priceData['original_price'] }}</del> @endif`
            //     );
            // }

            $(document).on('click', '.pricing-card', function() {
                $('.pricing-card').removeClass('active');
                $(this).addClass('active');

                selectedPrice = parseFloat($(this).data('price'));
                productStock = parseInt($(this).data('var-qty')) || 0; // update stock per variant
                let variantId = $(this).data('id');
                let productId = $(this).data('product-id');

                let qty = parseInt($('.qty').val()) || 1;

                // prevent qty > stock after selecting a new variant
                if (qty > productStock) {
                    qty = productStock;
                    $('.qty').val(qty);
                    toastr.warning(`{{ __('lang.Maximum_stock_limit_is') }} ${productStock}`);
                }

                $('#addToCartBtn')
                    .attr('data-price', selectedPrice)
                    .attr('data-stock', productStock)
                    .attr('data-variant-id', variantId) // optional if you need variant id
                    .attr('data-product-id', productId);

                updatePriceDisplay(selectedPrice, qty);
            });
            // $(document).on('click', '.pricing-card', function() {
            //     $('.pricing-card').removeClass('active');
            //     $(this).addClass('active');

            //     selectedPrice = parseFloat($(this).data('price'));
            //     let qty = parseInt($('.qty').val()) || 1;

            //     updatePriceDisplay(selectedPrice, qty);
            // });

            // Plus button
            $('.qtyplus').off('click.quantity').on('click.quantity', function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (isProcessing) return;
                isProcessing = true;

                let $qtyInput = $(this).closest('.quantity').find('.qty');
                let qty = parseInt($qtyInput.val()) || 1;

                if (qty < productStock) {
                    qty += 1;
                    $qtyInput.val(qty);
                    updatePriceDisplay(selectedPrice, qty);
                } else {
                    toastr.warning(`{{ __('lang.Maximum_stock_limit_reached') }} (${productStock})`);
                }

                setTimeout(() => {
                    isProcessing = false;
                }, 200);
            });

            // Minus button
            $('.qtyminus').off('click.quantity').on('click.quantity', function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (isProcessing) return;
                isProcessing = true;

                let $qtyInput = $(this).closest('.quantity').find('.qty');
                let qty = parseInt($qtyInput.val()) || 1;

                if (qty > 1) {
                    qty -= 1;
                    $qtyInput.val(qty);
                    updatePriceDisplay(selectedPrice, qty);
                }

                setTimeout(() => {
                    isProcessing = false;
                }, 200);
            });

            // Manual input
            $('.qty').off('input.quantity').on('input.quantity', function() {
                let qty = parseInt($(this).val()) || 1;

                if (qty < 1) {
                    qty = 1;
                } else if (qty > productStock) {
                    qty = productStock;
                    toastr.warning(`{{ __('lang.Maximum_stock_limit_is') }} ${productStock}`);
                }

                $(this).val(qty);
                updatePriceDisplay(selectedPrice, qty);
            });

            // Update price function
            function updatePriceDisplay(price, quantity) {
                let total = (price * quantity).toFixed(2);
                $('#product_price').html(
                    `{{ config('app.currency') }} ${total} 
                    @if ($priceData['original_price']) 
                        <del>{{ $priceData['original_price'] }}</del> 
                    @endif`
                );
            }

            // Handle Add to Cart button
            $('#addToCartBtn.logging').off('click').on('click.logging', function() {
                var $button = $(this);
                var product_id = $('.product-id').val();
                var selected = $('.pricing-card.selected');
                var price = $('.price').val();
                var quantity = $('.qty').val();

                // Prepare data for AJAX request
                var data = {
                    _token: '{{ csrf_token() }}',
                    product_id: product_id,
                    variant_id: selected.data('id'),
                    price: price,
                    quantity: quantity
                };

                // AJAX request to add item to cart
                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);

                            // Update cart sidebar content
                            updateCartSidebar(response.cartItems, response.totalPrice);

                            // Show the cart sidebar
                            $('.menu-cart.style-2 .cart-box').show();

                            // Update cart icon count
                            updateCartCount(response.cartCount);
                        } else {
                            toastr.error(
                                '{{ __('lang.failed_to_remove_item') }}');
                        }
                    },
                    error: function(xhr) {
                        toastr.error(
                            '{{ __('lang.failed_to_remove_item') }}');
                    }
                });
            });

            $(document).off('click.quantity', '.remove-cart-item').on('click.quantity', '.remove-cart-item',
                function() {
                    var $item = $(this).closest('li');
                    var product_id = $item.data('product-id');
                    var is_model = $item.data('is-model') === 1;

                    var data = {
                        _token: '{{ csrf_token() }}',
                        product_id: product_id,
                        is_model: is_model
                    };
                    Swal.fire({
                        title: '{{ __('lang.are_you_sure') }}',
                        text: '{{ __('lang.do_you_to_remove_this_item') }}',
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
                var $cartList = $('.menu-cart.style-2 .cart-box ul');
                var $cartTotal = $('.totalPrice');
                $cartList.empty(); // Clear current cart items

                if (cartItems.length > 0) {
                    // Group items by product_id to prevent duplicates
                    var groupedItems = {};
                    var localTotalPrice = 0;

                    $.each(cartItems, function(index, item) {
                        var productId = item.product_id || item.id; // Handle different response formats
                        if (!groupedItems[productId]) {
                            groupedItems[productId] = {
                                ...item,
                                quantity: 0
                            };
                        }
                        groupedItems[productId].quantity += parseInt(item.quantity, 10);
                        localTotalPrice += parseFloat(item.price) * parseInt(item.quantity, 10);
                    });

                    // Render grouped items
                    $.each(groupedItems, function(productId, item) {
                        var photo = item.image ?
                            (item.image.includes(',') ?
                                window.baseURL + '/' + item.image.split(',')[0].trim() :
                                window.baseURL + '/' + item.image) :
                            window.baseURL + '/front/assets/img/product/01.jpg';

                        var cartItemHtml = `
                            <li data-product-id="${item.id}" data-is-model="0">
                                <a href="javascript:void(0);" class="remove remove-cart-item" title="Remove this item">
                                    <i class="fa fa-remove"></i>
                                </a>
                                <img src="${photo}" alt="${item.name}" />
                                <div class="cart-product">
                                    <a href="{{ route('product.detail', '') }}/${item.slug}" target="_blank">
                                        ${item.name}
                                    </a>
                                    <span>RM ${parseFloat(item.price).toFixed(2)}</span>
                                    <p class="quantity">${item.quantity} x</p>
                                </div>
                            </li>`;
                        $cartList.append(cartItemHtml);
                    });

                    // Update total price
                    $cartTotal.text(`RM ${parseFloat(totalPrice).toFixed(2)}`);

                    // Show cart buttons
                    $('.menu-cart.style-2 .cart-box .cart-button').show();
                } else {
                    $cartList.append('<li>{{ __('lang.no_item_cart') }}</li>');
                    $cartTotal.text(`RM 0.00`);
                    $('.menu-cart.style-2 .cart-box .cart-button').hide();
                }
            }

            // Function to update cart icon count
            function updateCartCount(count) {
                var $cartIconCount = $('.menu-cart.style-2 .cart-icon .total-count');
                if (count > 0) {
                    $cartIconCount.text(count).show();
                } else {
                    $cartIconCount.hide();
                }
            }

            // Existing cart sidebar toggle logic
            var $menuCart = $(".menu-cart.style-2");
            var $cartBox = $menuCart.find(".cart-box");
            var $cartIcon = $menuCart.find(".cart-icon");

            $cartBox.hide();

            // Toggle on cart icon click
            $cartIcon.off('click.quantity').on('click.quantity', function(e) {
                e.preventDefault();
                $cartBox.toggle();
            });

            // Hide cart when clicking outside
            $(document).off('click.quantity').on('click.quantity', function(e) {
                if (!$menuCart.is(e.target) && $menuCart.has(e.target).length === 0) {
                    $cartBox.hide();
                }
            });

            // Close button inside header
            var $closeHeader = $("#cartCloseHeader");
            if ($closeHeader.length) {
                $closeHeader.off('click.quantity').on('click.quantity', function() {
                    $closeHeader.closest(".cart-box").hide();
                });
            }

            // Also close on outside mousedown
            $(document).off('mousedown.quantity').on('mousedown.quantity', function(e) {
                if ($cartBox.is(":visible") && !$cartBox.is(e.target) && $cartBox.has(e.target).length ===
                    0) {
                    $cartBox.hide();
                }
            });
        });
    </script>
    <!-- Include Fancybox JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        // Initialize Fancybox
        Fancybox.bind("[data-fancybox='gallery']", {
            // Optional Fancybox settings
            loop: true,
            buttons: [
                "zoom",
                "slideShow",
                "fullScreen",
                "thumbs",
                "close"
            ]
        });
    </script>
    <script>
        $(document).ready(function() {
            // Handle Add to Cart button click
            $('.add-to-cart-btn').off('click').on('click', function() {
                var $button = $(this);
                var variantID = null;
                var product_id = $button.data('product-id');
                var price = $button.data('price');
                var stock = parseInt($button.data('stock')); // Available stock
                var quantityInput = $button.closest('.shop-btn').siblings('.cart-wrp').find('.qty').val();
                var quantity = parseInt(quantityInput) || 1; // Fallback to 1


                // Get selected attributes
                var selectedAttribute = $('.attribute-badge.active').data('id') || null;

                if ($('.pricing-card').length > 0) {
                    var selected = $('.pricing-card.active');
                    if (selected.length === 0) {
                        toastr.error('Please select a variant.');
                        return;
                    }

                    variantId = selected.data('id');
                    price = selected.data('price');
                    stock = selected.data('var-qty');
                }

                // ✅ Frontend stock check
                if (quantity > stock) {
                    toastr.error('{{ __('lang.Cannot_add_more_than_available_stock') }}');
                    return;
                }

                // Prepare data for AJAX request
                var data = {
                    _token: '{{ csrf_token() }}',
                    product_id: product_id,
                    variant_id: variantID,
                    price: price,
                    quantity: quantity,
                    stock: stock,
                    attribute_id: selectedAttribute
                };

                // AJAX request to add item to cart
                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);

                            // Update cart sidebar content
                            updateCartSidebar(response.cartItems, response.totalPrice);

                            // Show the cart sidebar
                            $('.menu-cart.style-2 .cart-box').show();

                            // Update cart icon count
                            updateCartCount(response.cartCount);
                        } else {
                            toastr.error(response.message || 'Failed to add to cart.');
                        }
                    },
                    error: function(xhr) {
                        let msg = xhr.responseJSON && xhr.responseJSON.message ? xhr
                            .responseJSON.message : 'Failed to add to cart.';
                        toastr.error(msg);
                    }
                });
            });


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
                    title: '{{ __('lang.are_you_sure') }}',
                    text: '{{ __('lang.do_you_to_remove_this_item') }}',
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
            //                 <li data-product-id="${item.id}" data-is-model="0">
            //                     <a href="javascript:void(0);" class="remove remove-cart-item" title="Remove this item">
            //                         <i class="fa fa-remove"></i>
            //                     </a>
            //                     <img src="${photo}" alt="${item.name}" />
            //                     <div class="cart-product">
            //                         <a href="{{ route('product.detail', '') }}/${item.slug}" target="_blank">
            //                             ${item.name}
            //                         </a>
            //                         <span>RM ${parseFloat(item.price).toFixed(2)}</span>
            //                         <p class="quantity">${item.quantity} x</p>
            //                     </div>
            //                 </li>`;
            //             $cartList.append(cartItemHtml);
            //         });

            //         // Update total price
            //         $cartTotal.text(`RM ${parseFloat(totalPrice).toFixed(2)}`);

            //         // Show cart buttons
            //         $('.menu-cart.style-2 .cart-box .cart-button').show();
            //     } else {
            //         $cartList.append('<li>{{ __('lang.no_item_cart') }}</li>');
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
@endsection
