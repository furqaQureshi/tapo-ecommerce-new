{{-- @extends('front.layouts.app')
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
    </style> --}}

    <!-- Shop Details Section Start -->
    {{-- <section class="shop-details-section section-padding fix shop-bg">
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
                                {!! $product->short_description !!}
                            </p> --}}
                            {{-- <div class="price-list">
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
    @endforeach--> --}}
                                    <!--</div>-->
                                {{-- @endif
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
                                                        $attribute = \App\Models\Attribute::find(
                                                            $productAttribute->attribute_id,
                                                        );
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
                                                                            @php
                                                                                $slug = strtolower($value);
                                                                                $slug = preg_replace(
                                                                                    '/[^a-z0-9]+/i',
                                                                                    ' ',
                                                                                    $slug,
                                                                                );
                                                                                $slug = preg_replace(
                                                                                    '/\s+/',
                                                                                    '-',
                                                                                    $slug,
                                                                                );
                                                                                $slug = trim($slug, '-');
                                                                            @endphp
                                                                            <input type="radio"
                                                                                id="attr-{{ $innerAttribute->id }}-{{ $slug }}"
                                                                                name="selected_attributes[{{ $productAttribute->attribute_id }}]"
                                                                                value="{{ trim($value) }}"
                                                                                class="attribute-radio d-none">
                                                                            {{-- hidden radio --}}

                                                                            {{-- <label
                                                                                for="attr-{{ $innerAttribute->id }}-{{ $slug }}"
                                                                                class="attribute-badge"
                                                                                data-id="{{ $productAttribute->attribute_id }}"
                                                                                data-attr-qty="{{ $innerAttribute->qty }}"
                                                                                data-price="{{ $innerAttribute->price ?? 0 }}"
                                                                                data-discount="{{ $innerAttribute->discount ?? 0 }}"
                                                                                data-name="{{ @$productAttribute->attribute?->name }}"
                                                                                data-value="{{ strtolower(trim($value)) }}">
                                                                                {{ ucfirst(trim($value)) }}
                                                                            </label>
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach --}}

                                                                {{-- Hidden input to store selected values (as JSON or comma-separated) --}}
                                                                {{-- <input type="hidden"
                                                                    name="selected_attributes[{{ $productAttribute->attribute_id }}]"
                                                                    id="selected-{{ $productAttribute->attribute_id }}">
                                                            </div>
                                                        </div>
                                                        @php
                                                            $processedAttributes[] = $productAttribute->attribute_id;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div> --}}
                                        {{-- @else
                                        <p class="no-options">{{ __('lang.No_attributes_available_for_this_product') }}</p> --}}
                                    {{-- @endif
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

                                    /* hide the native radio */
                                    .attribute-radio {
                                        display: none;
                                    }

                                    /* when checked, style the label like active badge */
                                    .attribute-radio:checked+.attribute-badge {
                                        background: #f3f4f6;
                                        color: #f58c9d;
                                        border: 2px solid #f58c9d;
                                        position: relative;
                                    }

                                    /* add the dot indicator */
                                    .attribute-radio:checked+.attribute-badge::after {
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
                                </style>

                                <script> --}}
                                    {{-- // document.addEventListener('DOMContentLoaded', function() {
                                    //     const buttons = document.querySelectorAll('.attribute-badge');

                                    //     buttons.forEach(button => {
                                    //         button.addEventListener('click', function() {
                                    //             buttons.forEach(btn => btn.classList.remove('active'));
                                    //             this.classList.add('active');
                                    //         });
                                    //     });
                                    // });
                                    // document.addEventListener('DOMContentLoaded', function() {
                                    //     const buttons = document.querySelectorAll('.attribute-badge');

                                    //     buttons.forEach(button => {
                                    //         button.addEventListener('click', function() {
                                    //             const groupId = this.dataset.id; // get attribute group

                                    //             // remove active only from labels of the same group
                                    //             document.querySelectorAll(`.attribute-badge[data-id="${groupId}"]`)
                                    //                 .forEach(btn => btn.classList.remove('active'));

                                    //             // add active to clicked one
                                    //             this.classList.add('active');

                                    //             // also check the corresponding hidden radio
                                    //             const radio = document.getElementById(this.getAttribute('for'));
                                    //             if (radio) {
                                    //                 radio.checked = true;
                                    //             }
                                    //         });
                                    //     });
                                    // });
                                </script> --}}

                                {{-- @php
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
                                <input type="hidden" name="discount" class="discount" value="0">
                                <h3 id="product_price" class="d-none">{{ $priceData['formatted_price'] }}
                                    @if ($priceData['original_price'])
                                        <del>{{ $priceData['original_price'] }}</del>
                                    @endif
                                </h3>
                                @if ($product->points > 1000000000000000)
                                    <p>{{ __('lang.Buy_this_product_now_and_earn') }} <b>{{ $product->points }}</b>
                                        {{ __('lang.Points') }}</p>
                                @endif

                                @if ($priceData['discount_percentage'] > 0)
                                    <div class="badge badge-discount d-none">{{ $priceData['discount_percentage'] }}%</div>
                                @endif
                            </div>
                            <div class="cart-wrp d-none"> --}}
                                {{-- <div class="cart-quantity" style="display: none;">
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
                                <div class="social-profile d-none">
                                    <span class="plus-btn"><i class="far fa-share"></i></span>
                                    <ul>
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ route('product.detail', $product->slug) }}"
                                                target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="https://www.instagram.com/create/details/?url={{ route('product.detail', $product->slug) }}"
                                                target="_blank"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="https://www.tiktok.com/share/url?url={{ route('product.detail', $product->slug) }}"
                                                target="_blank"><i class="fab fa-tiktok"></i></a></li>
                                    </ul>
                                </div>
                                <p>{{ __('lang.stock') }} <b>{{ $product->qty }}</b> {{ __('lang.available') }}</p>
                            </div>
                            <div class="shop-btn">
                                @if ($product->qty > 0)
                                    @if ($product->is_subscription == 1)
                                        <a href="{{ route('choose-products') }}"
                                            class="hs-btn hs-btn-primary text-center">
                                            <span
                                                style="margin-left: 9em; display: flex;
                                                    justify-content: center;
                                                    align-items: center;
                                                    margin: auto;
                                                    font-size: 16px;">{{ __('lang.try_now_zera_moms_club') }}</span>
                                            <!-- <img src="{{ asset('front/assets/img/extra-dis.png') }}" alt="img" /> -->
                                        </a>
                                    @else
                                        <a href="javascript:void(0);" class="custom-rdxbtnr add-to-cart-btn"
                                            data-product-id="{{ $product->id }}" data-stock="{{ $product->qty }}"
                                            data-price="{{ $afterDiscount }}" id="addToCartBtn">
                                            <span></span>
                                            <span>{{ __('lang.Add_to_cart') }}</span>
                                            <img src="{{ asset('front/assets/img/extra-dis.png') }}" alt="img" />
                                        </a>
                                    @endif
                                @else
                                    <a href="javascript:void(0);" class="custom-rdxbtnr disabled-link">
                                        <span>{{ __('lang.out_of_stock') }}</span>
                                        <img src="{{ asset('front/assets/img/shape-1.png') }}" alt="img" />
                                    </a>
                                @endif
                            </div>
                            @if ($product->is_affiliate)
                                <p class="text-center d-none">{{ __('lang.or') }}</p>
                                <p class="d-none">{{ __('lang.Purchase_from') }}</p>
                                <div class="shop-btn-2 d-none">
                                    @if (!empty($product->affiliates))
                                        @foreach ($product->affiliates as $affiliate)
                                            <a href="{{ $affiliate->link }}"
                                                class="theme-btn shopee-btn"><span>{{ $affiliate->title }}</span></a>
                                        @endforeach
                                    @endif
                                </div>
                            @endif
                            <h6 class="details-info d-none"><span>{{ __('lang.Categories') }}:</span>
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
    </section> --}}

    <!-- Single-tab Section Start -->
    {{-- <section class="single-tab-section section-padding fix pt-0">
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
    </section> --}}

    <!-- Product-collection Section Start -->
    {{-- <section class="product-collection-section-2 section-padding pt-0 fix">
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
        var selectedPrice = $('.price').val();
        var originalProPrice = "{{ $afterDiscount }}";
        var productDiscoount = 0;
    </script>
    <script>
        $(document).ready(function() {
            $('.attribute-badge').on('click', function() {
                const groupId = $(this).data('id'); // get attribute group

                // remove active only from labels of the same group
                $(`.attribute-badge[data-id="${groupId}"]`).removeClass('active');

                // add active to clicked one
                $(this).addClass('active');

                // also check the corresponding hidden radio
                const radioId = $(this).attr('for');
                if (radioId) {
                    $('#' + radioId).prop('checked', true);
                }

                const qty = $('.qty').val();
                const stockQty = $(this).data('attr-qty');
                productDiscoount = $(this).data('discount');
                selectedPrice = $(this).data('price');

                console.log(selectedPrice);
                if (selectedPrice > 0) { --}}
                    {{-- // $('#addToCartBtn')
                    //     .attr('data-price', selectedPrice - (productDiscoount ?? 0))
                    //     .attr('data-stock', stockQty)
                    //     .attr('data-product-discount', productDiscoount)

                    $('#addToCartBtn')
                        .data('price', selectedPrice - (productDiscoount ?? 0))
                        .data('stock', stockQty)
                        .data('product-discount', productDiscoount ?? 0);

                    $('.price').val(selectedPrice - (productDiscoount ?? 0));
                    $('.discount').val(productDiscoount ?? 0);
                    updatePriceDisplay(selectedPrice, qty, productDiscoount);
                } else {
                    selectedPrice = $('.price').val();
                }
            }); --}}
            {{-- // Star rating functionality
            // $('.rating-stars .fa-star').on('click', function() {
            //     let rating = $(this).data('value');
            //     $('#rating-input').val(rating);

            //     // Reset all stars
            //     $('.rating-stars .fa-star').each(function() {
            //         $(this).removeClass('text-warning').addClass('text-muted');
            //     });

            //     // Highlight selected stars
            //     $('.rating-stars .fa-star').each(function() {
            //         if ($(this).data('value') <= rating) {
            //             $(this).removeClass('text-muted').addClass('text-warning');
            //         }
            //     });
            // });

            // // Form submission
            // $('#review-form').on('submit', function(e) {
            //     let rating = $('#rating-input').val();
            //     if (rating == 0) {
            //         e.preventDefault();
            //         toastr.error('{{ __('lang.Please_select_a_star_rating') }}');
            //         return false;
            //     }
            // });

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

            // $(document).on('click', '.pricing-card', function() {
            //     $('.pricing-card').removeClass('active');
            //     $(this).addClass('active');

            //     selectedPrice = parseFloat($(this).data('price'));
            //     productStock = parseInt($(this).data('var-qty')) || 0; // update stock per variant
            //     let variantId = $(this).data('id');
            //     let productId = $(this).data('product-id');

            //     let qty = parseInt($('.qty').val()) || 1;

            //     // prevent qty > stock after selecting a new variant
            //     if (qty > productStock) {
            //         qty = productStock;
            //         $('.qty').val(qty);
            //         toastr.warning(`{{ __('lang.Maximum_stock_limit_is') }} ${productStock}`);
            //     }

            //     $('#addToCartBtn')
            //         .attr('data-price', selectedPrice)
            //         .attr('data-stock', productStock)
            //         .attr('data-variant-id', variantId) // optional if you need variant id
            //         .attr('data-product-id', productId);

            //     updatePriceDisplay(selectedPrice, qty);
            // });
            // $(document).on('click', '.pricing-card', function() {
            //     $('.pricing-card').removeClass('active');
            //     $(this).addClass('active');

            //     selectedPrice = parseFloat($(this).data('price'));
            //     let qty = parseInt($('.qty').val()) || 1;

            //     updatePriceDisplay(selectedPrice, qty);
            // }); --}}

            {{-- // Plus button
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
            // function updatePriceDisplay(price, quantity, discount = 0) {
            //     let total = (price * quantity).toFixed(2);
            //     $('#product_price').html(
            //         `{{ config('app.currency') }} ${total}
        //         @if ($priceData['original_price'])
        //             <del>{{ $priceData['original_price'] }}</del>
        //         @endif`
            //     );
            // }

            function updatePriceDisplay(price, quantity, discount = 0) {
                let total = (price * quantity).toFixed(2);
                let currency = "{{ config('app.currency') }}";
                let originalPrice = "{{ $priceData['original_price'] ?? '' }}";

                if (productDiscoount > 0) {
                    discount = productDiscoount;
                }

                let html = '';

                // ${currency} ${(total - discount).toFixed(2)}
                if (discount > 0) {
                    html = `
                        ${currency} ${((price - discount) * quantity).toFixed(2)}
                        <del>${currency} ${total}</del>
                    `;
                } else if (originalPrice) {
                    html = `
                        ${currency} ${total}
                        <del>${currency} ${originalPrice}</del>
                    `;
                } else {
                    html = `${currency} ${total}`;
                }

                $('#product_price').html(html);
            }

            // Handle Add to Cart button
            // $('#addToCartBtn.logging').off('click').on('click.logging', function() {
            //     var $button = $(this);
            //     var product_id = $('.product-id').val();
            //     var selected = $('.pricing-card.selected');
            //     var price = $('.price').val();
            //     var quantity = $('.qty').val();

            //     // Prepare data for AJAX request
            //     var data = {
            //         _token: '{{ csrf_token() }}',
            //         product_id: product_id,
            //         variant_id: selected.data('id'),
            //         price: price,
            //         quantity: quantity
            //     };

            //     // AJAX request to add item to cart
            //     $.ajax({
            //         url: "{{ route('cart.add') }}",
            //         method: 'POST',
            //         data: data,
            //         success: function(response) {
            //             if (response.success) {
            //                 toastr.success(response.message);

            //                 // Update cart sidebar content
            //                 updateCartSidebar(response.cartItems, response.totalPrice);

            //                 // Show the cart sidebar
            //                 $('.menu-cart.style-2 .cart-box').show();

            //                 // Update cart icon count
            //                 updateCartCount(response.cartCount);
            //             } else {
            //                 toastr.error(
            //                     '{{ __('lang.failed_to_remove_item') }}');
            //             }
            //         },
            //         error: function(xhr) {
            //             toastr.error(
            //                 '{{ __('lang.failed_to_remove_item') }}');
            //         }
            //     });
            // });

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
            } --}}

            {{-- // Existing cart sidebar toggle logic
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
    </script> --}}
    <!-- Include Fancybox JS -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
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
        let hasAttributes = {{ $product->attributes->count() > 0 ? 'true' : 'false' }};
    </script> --}}
    {{-- <script>
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
                // var selectedAttribute = $('.attribute-badge.active').data('id') || null;
                var selectedAttribute = [];

                // $('.attribute-badge.active').each(function() {
                //     selectedAttribute.push({
                //         id: $(this).data('id'),
                //         value: $(this).data('value')
                //     });
                // });

                $('.attribute-badge.active').each(function() {
                    selectedAttribute.push({
                        id: $(this).data('id'),
                        name: $(this).data('name'),
                        value: $(this).data('value')
                    });
                });

                if (hasAttributes && selectedAttribute.length === 0) {
                    toastr.warning('{{ __('lang.Please_select_attributes') }}');
                    return false;
                }

                // selectedAttribute = JSON.stringify(selectedAttribute);

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

            // active function
            function updateCartSidebar(cartItems, totalPrice) {
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
    </script> --}}
{{-- @endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        $(document).ready(function() {
            // Star rating
            $('.star-rating .fa').on('click', function() {
                let rating = $(this).data('rating');
                $('#rating-input').val(rating);
                $('.star-rating .fa').removeClass('selected');
                $(this).prevAll().addBack().addClass('selected');
            });

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

            // Reviews toggle
            $('#showReviews').on('click', function() {
                $('#reviewSection').slideToggle();
            });
        });
    </script>
    <script>
        // var productStock = {{ $product->qty }};
        // var selectedPrice = {{ $afterDiscount }};
        // let hasAttributes = {{ $product->attributes->count() > 0 ? 'true' : 'false' }};
    </script> --}}

    <!-- Cart Related Scripts -->
    {{-- <script>
        $(document).ready(function() {
            let isProcessing = false;

            /** =========================
             *  Variant Selection
             *  ========================= */
            $(document).on('click', '.pricing-card', function() {
                $('.pricing-card').removeClass('active');
                $(this).addClass('active');

                selectedPrice = parseFloat($(this).data('price'));
                productStock = parseInt($(this).data('var-qty')) || 0;

                let variantId = $(this).data('id');
                let productId = $(this).data('product-id');
                let qty = parseInt($('.qty').val()) || 1;

                if (qty > productStock) {
                    qty = productStock;
                    $('.qty').val(qty);
                    toastr.warning(`{{ __('lang.Maximum_stock_limit_is') }} ${productStock}`);
                }

                $('#addToCartBtn')
                    .attr('data-price', selectedPrice)
                    .attr('data-stock', productStock)
                    .attr('data-variant-id', variantId)
                    .attr('data-product-id', productId);

                updatePriceDisplay(selectedPrice, qty);
            });

            /** =========================
             *  Quantity Handlers
             *  ========================= */
            $('.qtyplus').off('click.quantity').on('click.quantity', function(e) {
                e.preventDefault();
                if (isProcessing) return;
                isProcessing = true;

                let $qtyInput = $(this).closest('.quantity').find('.qty');
                let qty = parseInt($qtyInput.val()) || 1;

                if (qty < productStock) {
                    qty++;
                    $qtyInput.val(qty);
                    updatePriceDisplay(selectedPrice, qty);
                } else {
                    toastr.warning(`{{ __('lang.Maximum_stock_limit_reached') }} (${productStock})`);
                }

                setTimeout(() => isProcessing = false, 200);
            });

            $('.qtyminus').off('click.quantity').on('click.quantity', function(e) {
                e.preventDefault();
                if (isProcessing) return;
                isProcessing = true;

                let $qtyInput = $(this).closest('.quantity').find('.qty');
                let qty = parseInt($qtyInput.val()) || 1;

                if (qty > 1) {
                    qty--;
                    $qtyInput.val(qty);
                    updatePriceDisplay(selectedPrice, qty);
                }

                setTimeout(() => isProcessing = false, 200);
            });

            $('.qty').off('input.quantity').on('input.quantity', function() {
                let qty = parseInt($(this).val()) || 1;

                if (qty < 1) qty = 1;
                if (qty > productStock) {
                    qty = productStock;
                    toastr.warning(`{{ __('lang.Maximum_stock_limit_is') }} ${productStock}`);
                }

                $(this).val(qty);
                updatePriceDisplay(selectedPrice, qty);
            });

            function updatePriceDisplay(price, quantity) {
                let total = (price * quantity).toFixed(2);
                $('#product_price').html(
                    `{{ config('app.currency') }} ${total}
                    @if ($priceData['original_price'])
                        <del>{{ $priceData['original_price'] }}</del>
                    @endif`
                );
            }

            /** =========================
             *  Add to Cart
             *  ========================= */
            $('.add-to-cart-btn').off('click').on('click', function() {
                var $button = $(this);
                var product_id = $button.data('product-id');
                var price = $button.data('price');
                var stock = parseInt($button.data('stock'));
                var quantity = parseInt($('.qty').val()) || 1;
                var variantID = null;
                var selectedAttribute = [];

                $('.attribute-badge.active').each(function() {
                    selectedAttribute.push({
                        id: $(this).data('id'),
                        name: $(this).data('name'),
                        value: $(this).data('value')
                    });
                });

                if (hasAttributes && selectedAttribute.length === 0) {
                    toastr.warning('{{ __("lang.Please_select_attributes") }}');
                    return false;
                }

                if ($('.pricing-card').length > 0) {
                    var selected = $('.pricing-card.active');
                    if (selected.length === 0) {
                        toastr.error('{{ __("lang.Please_select_variant") }}');
                        return;
                    }
                    variantID = selected.data('id');
                    price = selected.data('price');
                    stock = selected.data('var-qty');
                }

                if (quantity > stock) {
                    toastr.error('{{ __("lang.Cannot_add_more_than_available_stock") }}');
                    return;
                }

                var data = {
                    _token: '{{ csrf_token() }}',
                    product_id: product_id,
                    variant_id: variantID,
                    price: price,
                    quantity: quantity,
                    stock: stock,
                    attribute_id: selectedAttribute
                };

                $.post("{{ route('cart.add') }}", data, function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        updateCartSidebar(response.cartItems, response.totalPrice);
                        $('.menu-cart.style-2 .cart-box').show();
                        updateCartCount(response.cartCount);
                    } else {
                        toastr.error(response.message || 'Failed to add to cart.');
                    }
                }).fail(function(xhr) {
                    let msg = xhr.responseJSON?.message || 'Failed to add to cart.';
                    toastr.error(msg);
                });
            });

            /** =========================
             *  Remove from Cart
             *  ========================= */
            $(document).on('click', '.remove-cart-item', function() {
                var $item = $(this).closest('li');
                var data = {
                    _token: '{{ csrf_token() }}',
                    product_id: $item.data('product-id'),
                    is_model: $item.data('is-model') === 1
                };

                Swal.fire({
                    title: '{{ __("lang.are_you_sure") }}',
                    text: '{{ __("lang.do_you_to_remove_this_item") }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, remove it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("{{ route('cart.remove') }}", data, function(response) {
                            if (response.success) {
                                toastr.success(response.message);
                                updateCartSidebar(response.cartItems, response.totalPrice);
                                updateCartCount(response.cartCount);
                            } else {
                                toastr.error('Failed to remove item.');
                            }
                        }).fail(() => toastr.error('Failed to remove item.'));
                    }
                });
            });

            /** =========================
             *  Cart Sidebar
             *  ========================= */
            function updateCartSidebar(cartItems, totalPrice) {
                var $cartList = $('.menu-cart.style-2 .cart-box ul');
                var $cartTotal = $('.totalPrice');
                $cartList.empty();

                if (cartItems.length > 0) {
                    var groupedItems = {};
                    $.each(cartItems, function(_, item) {
                        var productId = item.product_id || item.id;
                        if (!groupedItems[productId]) {
                            groupedItems[productId] = { ...item, quantity: 0 };
                        }
                        groupedItems[productId].quantity += parseInt(item.quantity, 10);
                    });

                    $.each(groupedItems, function(_, item) {
                        var photo = item.image ?
                            (item.image.includes(',') ?
                                window.baseURL + '/' + item.image.split(',')[0].trim() :
                                window.baseURL + '/' + item.image) :
                            window.baseURL + '/front/assets/img/product/01.jpg';

                        $cartList.append(`
                            <li data-product-id="${item.id}" data-is-model="0">
                                <a href="javascript:void(0);" class="remove remove-cart-item">
                                    <i class="fa fa-remove"></i>
                                </a>
                                <img src="${photo}" alt="${item.name}" />
                                <div class="cart-product">
                                    <a href="{{ route('product.detail', '') }}/${item.slug}" target="_blank">${item.name}</a>
                                    <span>RM ${parseFloat(item.price).toFixed(2)}</span>
                                    <p class="quantity">${item.quantity} x</p>
                                </div>
                            </li>
                        `);
                    });

                    $cartTotal.text(`RM ${parseFloat(totalPrice).toFixed(2)}`);
                    $('.menu-cart.style-2 .cart-box .cart-button').show();
                } else {
                    $cartList.append('<li>{{ __("lang.no_item_cart") }}</li>');
                    $cartTotal.text(`RM 0.00`);
                    $('.menu-cart.style-2 .cart-box .cart-button').hide();
                }
            }

            function updateCartCount(count) {
                var $cartIconCount = $('.menu-cart.style-2 .cart-icon .total-count');
                count > 0 ? $cartIconCount.text(count).show() : $cartIconCount.hide();
            }

            /** =========================
             *  Sidebar Toggle
             *  ========================= */
            var $menuCart = $(".menu-cart.style-2"),
                $cartBox = $menuCart.find(".cart-box"),
                $cartIcon = $menuCart.find(".cart-icon");

            $cartBox.hide();

            $cartIcon.on("click", function(e) {
                e.preventDefault();
                $cartBox.toggle();
            });

            $(document).on("click mousedown", function(e) {
                if (!$menuCart.is(e.target) && $menuCart.has(e.target).length === 0) {
                    $cartBox.hide();
                }
            });

            $("#cartCloseHeader").on("click", function() {
                $(this).closest(".cart-box").hide();
            });
        });
    </script>
 @endsection --}}

 
@extends('front.layouts.urwah_partials.app')
@section('content')
<style>
.toast {
    color: #fff !important;
}

.toast-success {
    background-color: #51A351 !important;
}

.toast-error {
    background-color: #BD362F !important;
}

.toast-info {
    background-color: #2F96B4 !important;
}

.toast-warning {
    background-color: #F89406 !important;
}
</style>
  <main>
                    <!--======  Start Shop Details Section  ======-->
                    <section class="bistly-shop-details-sec primary-bgcolor-3 mt-5 py-5">
                        <div class="container">
                            <!-- Shop Details Wrapper -->
                            <div class="shop-details-wrapper py-5">
                                <div class="row pt-4">
                                    <div class="col-xl-5">
                                        <!-- Product Gallery Slider -->
                                        <div class="product-gallery-slider mb-50" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="10">
                                           <div class="product-big-slider mb-30">
                                             @foreach($product->media->take(4) as $image)
                                                <div class="product-img">
                                                    <a href="{{asset($image->image_path)}}" class="img-popup">
                                                        <img src="{{asset($image->image_path)}}" alt="{{ $product->name }}">
                                                    </a>
                                                </div>
                                                @endforeach
                                            </div>
                                            <!-- Product Thumb Slider -->
                                            <div class="product-thumb-slider">
                                                @foreach($product->media->take(4) as $image)
                                                <div class="product-img">
                                                    <img src="{{asset($image->image_path)}}" alt="Product">
                                                </div>
                                                @endforeach    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-7">
                                        <!-- Product Info -->
                                        <div class="product-info mb-50" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="10">
                                            <h4 class="title">{{$product->name}}</h4>
                                            {{-- <div class="ratings">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <a href="#">(20 Reviews)</a>
                                            </div> --}}
                                            {{-- <p class="product-main-info">50 Pieces per Box</p> --}}

                                            <div class="product-description-info" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="10">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="bistly-tabs">
                                                            <ul class="nav nav-tabs">
                                                                <li>
                                                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#description">Description</button>
                                                                </li>
                                                                <li>
                                                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#info">Features</button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-content">
                                                            <div class="tab-pane fade show active" id="description">
                                                                <div class="bistly-content-box">
                                                                    <p>{!! $product->description !!}</p>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="info">
                                                                <div class="bistly-content-box">
                                                                    <div class="row mt-3">
                                                                        <div class="col-sm-4">
                                                                            <!-- Bistly Iconic Box -->
                                                                            <div class="bistly-iconic-box mb-4" data-aos="fade-up" data-aos-duration="1400">
                                                                                <div class="icon">
                                                                                    <img src="{{asset('assets/images/home/single-product/sustainability.png')}}" alt="shape">
                                                                                </div>
                                                                                <div class="content">
                                                                                    <p>Sustainability</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <!-- Bistly Iconic Box -->
                                                                            <div class="bistly-iconic-box mb-4" data-aos="fade-up" data-aos-duration="1200">
                                                                                <div class="icon">
                                                                                    <img src="{{asset('assets/images/home/single-product/leak.png')}}" alt="shape">
                                                                                </div>
                                                                                <div class="content">
                                                                                    <p>Leak-Resistant</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <!-- Bistly Iconic Box -->
                                                                            <div class="bistly-iconic-box mb-4" data-aos="fade-up" data-aos-duration="1400">
                                                                                <div class="icon">
                                                                                    <img src="{{asset('assets/images/home/single-product/durable.png')}}" alt="shape">
                                                                                </div>
                                                                                <div class="content">
                                                                                    <p>Durable & Strong</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sn-quantity-container">
                                                <h5>1. CHOOSE QUANTITY</h5>
                                                <input type="hidden" id="product_id" value="{{ $product->id }}">
                                                <input type="hidden" id="box-selected" value="1">
                                                <input type="hidden" id="add-on-products" value="">
                                                <div class="row">
                                                    <!-- 1 Box Option -->
                                                    <div class="col-md-4 mb-3">
                                                        <label class="sn-quantity-option" onclick="changeAddToCartPrice(1)">
                                                        <input type="hidden" class="boxes" value="selected">
                                                            <input type="hidden" id="box1" value="{{ productPriceWithDiscount($product->id) }}" selected>
                                                            <input type="radio" name="quantity" value="1" checked>
                                                            <div class="sn-quantity-details">
                                                                <h4>1 Box</h4>
                                                                @if(empty($product->discount))
                                                                <div class="sn-price">RM 
                                                                {{$product->price}}
                                                                </div>
                                                                @else
                                                                <div class="sn-price">
                                                                RM <s style="color:black;">{{$product->price}}</s>
                                                                @php
                                                                $price = number_format($product->price*$product->discount/100,2);
                                                                $disCountedPrice = number_format($product->price-$price,2);
                                                                @endphp
                                                                {{$disCountedPrice}}
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </label>
                                                    </div>

                                                    <!-- 2 Boxes Option -->
                                                    @if(!empty($product->box_price_2_discount))
                                                    <div class="col-md-4 mb-3">
                                                        <label class="sn-quantity-option" onclick="changeAddToCartPrice(2)">
                                                        <input type="hidden" class="boxes" value="">
                                                            <input type="hidden" id="box2" value="{{ $box2Price }}">

                                                            <div class="sn-badge-container">
                                                                <span class="sn-custom-badge sn-badge-discount">RM {{ $box2DiscountPrice }} OFF</span>
                                                                <span class="sn-custom-badge sn-badge-popular">POPULAR</span>
                                                            </div>
                                                            <input type="radio" name="quantity" value="2" >
                                                            <div class="sn-quantity-details">
                                                                <h4>2 Boxes</h4>
                                                                <div class="sn-price">RM {{ number_format($box2Price,2) }}</div>
                                                            </div>
                                                        </label>
                                                    </div>

                                                    <!-- 3 Boxes Option -->
                                                    <div class="col-md-4 mb-3">
                                                        <label class="sn-quantity-option" onclick="changeAddToCartPrice(3)">
                                                        <input type="hidden" class="boxes" value="">
                                                            <input type="hidden" id="box3" value="{{ $box3Price }}">
                                                            <div class="sn-badge-container">
                                                                <span class="sn-custom-badge sn-badge-discount">RM {{ $box3DiscountPrice }} OFF</span>
                                                                <span class="sn-custom-badge sn-badge-best-value">BEST VALUE</span>
                                                            </div>
                                                            <input type="radio" name="quantity" value="3">
                                                            <div class="sn-quantity-details">
                                                                <h4>3 Boxes</h4>
                                                                <div class="sn-price">RM {{ number_format($box3Price,2) }}</div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Add Ons Section -->
                                            <div class="sn-addon-container">
                                            @if($product->addOnProducts()->count()>0)
                                                <h5>2. CHOOSE ADD ONS</h5>
                                                    @foreach($product->addOnProducts as $addOnProduct)
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label class="sn-addon-option" onclick="updateCartPrice({{$addOnProduct->id}},{{ $addOnProduct->add_on_product_id }})">
                                                                <img src="{{url($addOnProduct->adOnProduct->media[0]->image_path)}}"
                                                                    alt="Gluten Free Laksa Noodles"
                                                                    class="sn-addon-image">
                                                                <input type="checkbox" name="addon" class="add-on-product-checkbox" data-ad-on-product-id="{{ $addOnProduct->add_on_product_id }}" data-ad-on-product-price="{{ $addOnProduct->adOnProduct->price }}" id="add-on-product-checkbox{{$addOnProduct->id}}" value="{{ $addOnProduct->adOnProduct->price }}">
                                                                <div class="sn-addon-details">
                                                                    <div class="sn-addon-title">
                                                                        {{ $addOnProduct->adOnProduct->name }}
                                                                    </div>
                                                                </div>
                                                                <div class="sn-addon-price">RM {{ $addOnProduct->adOnProduct->price }}</div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                            </div>
                                             @endif
                                             <p>SKU: {{ $product->sku }}</p>
                                            <div class="product-cart-variation mb-70">
                                                <ul>
                                                    <li>
                                                        <div class="quantity-input">
                                                            <button class="quantity-down"><i class="far fa-angle-left"></i></button>
                                                            <input class="quantity" type="text" value="1" name="quantity">
                                                            <button class="quantity-up"><i class="far fa-angle-right"></i></button>
                                                        </div>
                                                    </li>
                                                    <li id="price">
                                                        <a href="javascript:void(0);" class="theme-btn style-one sb-addtocart-btn1"><p class="price"><span class="currency">RM</span>
                                                        @php
                                                        $discount = $product->price*$product->discount/100;
                                                        $price = number_format($product->price-$discount,2);

                                                        @endphp
                                                        {{ $price }} </p> - Add To cart </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <ul class="check-list style-one">
                                                <li><i class="flaticon-check"></i>30 days easy returns</li>
                                                <li><i class="flaticon-check"></i>Order yours before 2.30pm for same day dispatch</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="sn-reviews-section py-5 mt-5 mb-5">
                        <div class="container">
                            <!-- Section Header -->
                            <div class="d-flex justify-content-between align-items-center mb-5">
                                <div>
                                    <h2 class="primary-color-1">Reviews</h2>
                                </div>
                                <button class="theme-btn style-one" onclick="document.getElementById('reviewFormContainer').classList.toggle('show')">Write a Review</button>
                            </div>

                            <!-- Review Form Container (Initially Hidden) -->
                            <div class="sn-review-form-container" id="reviewFormContainer">
                                <div class="sn-form-header">
                                    <h5 class="primary-color-1">Write Your Review</h5>
                                    <button type="button" class="btn-close" onclick="toggleReviewForm()" aria-label="Close"></button>
                                </div>
                                <form id="reviewForm">
                                    <!-- Star Rating -->
                                    <div class="mb-4">
                                        <label class="form-label sn-form-label sn-required-label">Rating</label>
                                        <div class="sn-star-rating" id="starRating">
                                            <i class="far fa-star" data-rating="1"></i>
                                            <i class="far fa-star" data-rating="2"></i>
                                            <i class="far fa-star" data-rating="3"></i>
                                            <i class="far fa-star" data-rating="4"></i>
                                            <i class="far fa-star" data-rating="5"></i>
                                        </div>
                                        <small class="text-muted">Click on stars to rate</small>
                                    </div>

                                    <!-- Name Field -->
                                    <div class="mb-4">
                                        <label for="reviewerName" class="form-label sn-form-label sn-required-label">Your Name</label>
                                        <input type="text" class="form-control sn-form-control" id="reviewerName" placeholder="Enter your name" required>
                                    </div>

                                    <!-- Review Text -->
                                    <div class="mb-4">
                                        <label for="reviewText" class="form-label sn-form-label sn-required-label">Your Review</label>
                                        <textarea class="form-control sn-form-control" id="reviewText" rows="5" placeholder="Share your experience in detail..." required></textarea>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="text-end">
                                        <button type="submit" class="theme-btn style-one">Submit Review</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Reviews Container -->
                            <div class="sn-reviews-container">
                                <div id="reviewsList">
                                    <!-- Review 1 -->
                                    <div class="sn-review-item">
                                        <div class="sn-review-header">
                                            <div class="sn-reviewer-avatar">AR</div>
                                            <div>
                                                <h6 class="sn-reviewer-name">Ahmad Rahman</h6>
                                                <small class="sn-review-date">3 days ago - Kuala Lumpur</small>
                                            </div>
                                            <div class="ms-auto sn-review-stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                        <p class="sn-review-text">Sangat impressed dengan biodegradable food packages ini! Kualiti sangat baik dan truly eco-friendly. Perfect untuk my restaurant di KL. Packaging kuat dan customers pun appreciate the environmental initiative.</p>
                                    </div>

                                    <!-- Review 2 -->
                                    <div class="sn-review-item">
                                        <div class="sn-review-header">
                                            <div class="sn-reviewer-avatar">SL</div>
                                            <div>
                                                <h6 class="sn-reviewer-name">Siti Lim</h6>
                                                <small class="sn-review-date">1 week ago - Penang</small>
                                            </div>
                                            <div class="ms-auto sn-review-stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                        </div>
                                        <p class="sn-review-text">Great biodegradable containers! Mudah decompose dan very practical for takeaway business. Delivery to Penang was fast. Only minor issue is slightly more expensive than regular plastic, but worth it for the environment!</p>
                                    </div>

                                    <!-- Review 3 -->
                                    <div class="sn-review-item">
                                        <div class="sn-review-header">
                                            <div class="sn-reviewer-avatar">MH</div>
                                            <div>
                                                <h6 class="sn-reviewer-name">Hassan Rahiim</h6>
                                                <small class="sn-review-date">2 weeks ago - Johor Bahru</small>
                                            </div>
                                            <div class="ms-auto sn-review-stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                        <p class="sn-review-text">Outstanding biodegradable packaging! Switched from plastic containers to these for my catering business. Customers love the eco-friendly approach and the quality is excellent. Highly recommended untuk semua food businesses in Malaysia!</p>
                                    </div>

                                    <!-- Review 4 -->
                                    <div class="sn-review-item">
                                        <div class="sn-review-header">
                                            <div class="sn-reviewer-avatar">NT</div>
                                            <div>
                                                <h6 class="sn-reviewer-name">Nurul Tan</h6>
                                                <small class="sn-review-date">3 weeks ago - Shah Alam</small>
                                            </div>
                                            <div class="ms-auto sn-review-stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                        <p class="sn-review-text">Perfect biodegradable food containers! Tahan panas dan sejuk, leak-proof, and best part adalah environmentally friendly. My home-based food business customers always compliment on the packaging. Delivery within Selangor was super quick!</p>
                                    </div>

                                    <!-- Hidden Reviews - Load More -->
                                    <div class="sn-review-item sn-hidden">
                                        <div class="sn-review-header">
                                            <div class="sn-reviewer-avatar">DW</div>
                                            <div>
                                                <h6 class="sn-reviewer-name">David Wong</h6>
                                                <small class="sn-review-date">1 month ago - Kota Kinabalu</small>
                                            </div>
                                            <div class="ms-auto sn-review-stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                        </div>
                                        <p class="sn-review-text">Very good biodegradable packaging for my Sabah restaurant chain. Quality control is consistent and decomposition rate is as promised. Good initiative for Malaysia's environment. Shipping to East Malaysia took bit longer but worth the wait.</p>
                                    </div>

                                    <div class="sn-review-item sn-hidden">
                                        <div class="sn-review-header">
                                            <div class="sn-reviewer-avatar">FS</div>
                                            <div>
                                                <h6 class="sn-reviewer-name">Fatimah Sulaiman</h6>
                                                <small class="sn-review-date">1 month ago - Ipoh</small>
                                            </div>
                                            <div class="ms-auto sn-review-stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                        <p class="sn-review-text">Excellent biodegradable food packaging! Switched completely from styrofoam untuk my nasi lemak business. Customers appreciate the environmental consciousness. Material sangat strong dan professional looking. Highly recommended for all Malaysian food entrepreneurs!</p>
                                    </div>

                                    <div class="sn-review-item sn-hidden">
                                        <div class="sn-review-header">
                                            <div class="sn-reviewer-avatar">RM</div>
                                            <div>
                                                <h6 class="sn-reviewer-name">Raj Mohan</h6>
                                                <small class="sn-review-date">1 month ago - Melaka</small>
                                            </div>
                                            <div class="ms-auto sn-review-stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                        <p class="sn-review-text">Fantastic biodegradable packaging solution! Perfect for my Indian restaurant chain. Customers are impressed with our eco-friendly initiative. The containers handle spicy curries perfectly without any leakage. Delivery to Melaka was prompt and professional.</p>
                                    </div>

                                    <div class="sn-review-item sn-hidden">
                                        <div class="sn-review-header">
                                            <div class="sn-reviewer-avatar">LW</div>
                                            <div>
                                                <h6 class="sn-reviewer-name">Linda Wong</h6>
                                                <small class="sn-review-date">2 months ago - Kuching</small>
                                            </div>
                                            <div class="ms-auto sn-review-stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                        </div>
                                        <p class="sn-review-text">Great eco-friendly packaging for my bakery in Sarawak! The biodegradable containers keep pastries fresh and customers love the environmental consciousness. Good quality materials and reasonable pricing. Shipping to East Malaysia was handled well.</p>
                                    </div>
                                </div>

                                <!-- Load More Button -->
                                <div class="text-center mt-4">
                                    <button class="theme-btn style-one" id="loadMoreBtn">
                                        <i class="fas fa-chevron-down me-2"></i>Load More Reviews
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!--====== Start Related Product Section ======-->
                    <section class="related-product-sec py-5 primary-bgcolor-1">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="section-title text-center pt-5 pb-5">
                                        <h2 class="primary-color">Related products</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="related-product-slider py-4" data-aos="fade-up" data-aos-duration="1000">
                                <!-- Bistly Product Item -->
                                <div class="bistly-product-item mb-4">
                                    <div class="thumbnail">
                                        <img src="assets/images/home/products/bowl.jpg" alt="Menu Image">
                                        <div class="wishlist-btn"><i class="fas fa-heart"></i></div>
                                    </div>
                                    <div class="content">
                                        <div class="ratings-price-wrap">
                                            <div class="ratings">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="price">RM 5.99</div>
                                            </div>
                                        </div>
                                        <h4><a href="#">Plain Brown Bowl 390ml</a></h4>
                                        <div class="add-to-cart theme-btn style-one"><a href="#">Add to Cart</a></div>
                                    </div>
                                </div>
                                <!-- Bistly Product Item -->
                                <div class="bistly-product-item mb-4">
                                    <div class="thumbnail">
                                        <img src="assets/images/home/products/plate.jpg" alt="Menu Image">
                                        <div class="wishlist-btn"><i class="fas fa-heart"></i></div>
                                    </div>
                                    <div class="content">
                                        <div class="ratings-price-wrap">
                                            <div class="ratings">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="price">RM 7.98</div>
                                            </div>
                                        </div>
                                        <h4><a href="#">Plain Brown Plate 7 inch</a></h4>
                                        <div class="add-to-cart theme-btn style-one"><a href="#">Add to Cart</a></div>
                                    </div>
                                </div>
                                <!-- Bistly Product Item -->
                                <div class="bistly-product-item mb-4">
                                    <div class="thumbnail">
                                        <img src="assets/images/home/products/tray.jpg" alt="Menu Image">
                                        <div class="wishlist-btn"><i class="fas fa-heart"></i></div>
                                    </div>
                                    <div class="content">
                                        <div class="ratings-price-wrap">
                                            <div class="ratings">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="price">RM 6.00</div>
                                            </div>
                                        </div>
                                        <h4><a href="#">Plain Brown Paper Tray 180x110x50</a></h4>
                                        <div class="add-to-cart theme-btn style-one"><a href="#">Add to Cart</a></div>
                                    </div>
                                </div>
                                <!-- Bistly Product Item -->
                                <div class="bistly-product-item mb-4">
                                    <div class="thumbnail">
                                        <img src="assets/images/home/products/lunch-box.jpg" alt="Menu Image">
                                        <div class="wishlist-btn"><i class="fas fa-heart"></i></div>
                                    </div>
                                    <div class="content">
                                        <div class="ratings-price-wrap">
                                            <div class="ratings">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="price">RM 5.99</div>
                                            </div>
                                        </div>
                                        <h4><a href="#">Plain Brown Lunch Box 180x110x50mm</a></h4>
                                        <div class="add-to-cart theme-btn style-one"><a href="#">Add to Cart</a></div>
                                    </div>
                                </div>
                                <!-- Bistly Product Item -->
                                <div class="bistly-product-item mb-4">
                                    <div class="thumbnail">
                                        <img src="assets/images/home/products/burger-box.jpg" alt="Menu Image">
                                        <div class="wishlist-btn"><i class="fas fa-heart"></i></div>
                                    </div>
                                    <div class="content">
                                        <div class="ratings-price-wrap">
                                            <div class="ratings">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="price">RM 8.99</div>
                                            </div>
                                        </div>
                                        <h4><a href="#">Plain Brown Burger Box 120x120x70mm</a></h4>
                                        <div class="add-to-cart theme-btn style-one"><a href="#">Add to Cart</a></div>
                                    </div>
                                </div>
                                <!-- Bistly Product Item -->
                                <div class="bistly-product-item mb-4">
                                    <div class="thumbnail">
                                        <img src="assets/images/home/products/noodle-box.jpg" alt="Menu Image">
                                        <div class="wishlist-btn"><i class="fas fa-heart"></i></div>
                                    </div>
                                    <div class="content">
                                        <div class="ratings-price-wrap">
                                            <div class="ratings">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="price">RM 6.00</div>
                                            </div>
                                        </div>
                                        <h4><a href="#">Plain Brown Noodle Box 95x80x100mm</a></h4>
                                        <div class="add-to-cart theme-btn style-one"><a href="#">Add to Cart</a></div>
                                    </div>
                                </div>
                                <!-- Bistly Product Item -->
                                <div class="bistly-product-item mb-4">
                                    <div class="thumbnail">
                                        <img src="assets/images/home/products/bag.jpg" alt="Menu Image">
                                        <div class="wishlist-btn"><i class="fas fa-heart"></i></div>
                                    </div>
                                    <div class="content">
                                        <div class="ratings-price-wrap">
                                            <div class="ratings">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="price">RM 6.00</div>
                                            </div>
                                        </div>
                                        <h4><a href="#">Plain Brown Bag Square 205x115x337mm</a></h4>
                                        <div class="add-to-cart theme-btn style-one"><a href="#">Add to Cart</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!--====== End Related Product Section ======-->
                </main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
// <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>

function changeAddToCartPrice(id)
{
    let addOnProductPrices = 0;
    let adOnProductRadio = document.getElementsByClassName('add-on-product-checkbox');
    for(let i = 0; i < adOnProductRadio.length; i++)
    {
        if(adOnProductRadio[i].checked)
        {
            let price = +adOnProductRadio[i].value;
            addOnProductPrices += price;
        }
    }

    let boxes = $('.boxes');
    for(let i=0; i < boxes.length; i++)
    {
        boxes[i].value="";
    }
    
    boxes[id-1].value="selected";
    $('#box-selected').val(id);


    let totalPrice = +$('#box'+id).val()+addOnProductPrices;
    // alert(totalPrice);

  let HTML = `<a href="javascript:void(0);" class="theme-btn style-one sb-addtocart-btn1"><p class="price"><span class="currency">RM</span>${totalPrice}</p> - Add To cart </a>`;

    $('#price').html(HTML); 
}

var productsForCart = [];

function updateCartPrice(productId,pId)
{
    // alert('here');

    addOnProductIds = $('#add-on-products').val();

    let addOnProductPrices = 0;
    let adOnProductRadio = document.getElementsByClassName('add-on-product-checkbox');

    let d ='';

    for(let i = 0; i < adOnProductRadio.length; i++)
    {
        if(adOnProductRadio[i].checked)
        {
            let price = +adOnProductRadio[i].value;
            addOnProductPrices += price;

            if(addOnProductIds.search(pId) == -1)
            {
                d=pId+",";
            }
        }
    }

    

    $('#add-on-products').val(addOnProductIds+d);


    let currentBoxPrice = 0;
    let boxes = document.getElementsByClassName('boxes');
    let b;
    for(let i=0; i < boxes.length; i++)
    {
        if(boxes[i].value=="selected")
        {
            let a = i+1;
            b=a;
            currentBoxPrice = $('#box'+a).val();    
        }
    }
    
    let totalPrice = +currentBoxPrice+addOnProductPrices;

    let HTML = `<a href="javascript:void(0);" class="theme-btn style-one sb-addtocart-btn1"><p class="price"><span class="currency">RM</span>${totalPrice}</p> - Add To cart </a>`;

    $('#price').html(HTML); 


    
    // alert(addOnProductPrices);
// 
    // document.getElementById('add-on-product-checkbox'+productId);
}



            $(document).on('click', '.sb-addtocart-btn1', function (e) {
                
                let numberOfBoxes = +$('#box-selected').val();

                var product_id = $('#product_id').val();
                var price = "{{ $product->price }}";
                var quantity = numberOfBoxes;
                let freeShippingAmount = "{{ $freeShippingPrice }}";
                let adOnProducts = $('.add-on-product-checkbox:checked');
                let totalAdOnProducts;
                let totalAmount;
                let totalAmount1;

                // alert(adOnProducts.length);
                // //  if(adOnProducts.length>0)
                // //             {
                // //                 alert('good');
                // //             }
                //             exit;

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: product_id,
                        price: price,
                        quantity: 1,
                        box:numberOfBoxes
                        // number_of_boxes:numberOfBoxes
                    },
                    success: function (response) {
                        // alert('good');
                        console.log(response);
                        if (response.success) {

                            console.log(response);

                            let cartItemsHTML = '';

                            if(response.cartItems.length>0)
                            {
                                  if(adOnProducts.length>0)
                                 {
                                 }
                                 else
                                 {
                                    for(let i=0;i<response.cartItems.length;i++)
                                    {
                                    cartItemsHTML += `<div class="sb-cart-item">
                                                                            <img src="{{ url('${response.cartItems[i].image}') }}" alt="Curry Paste" class="sb-item-image">
                                                                            <div class="sb-item-details">
                                                                                <div class="sb-item-name">${response.cartItems[i].name}</div>
                                                                                <div class="sb-item-price">
                                                                                    <div class="sb-original-price">
                                                                                        <!-- RM 220.80 -->
                                                                                        <span class="sb-discounted-price" style="margin-left:0px;">RM ${response.cartItems[i].price}</span></div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="sb-quantity-controls">`;
                                    // if(response.cartItems[i].type == "product")
                                    // {
                                        cartItemsHTML+=`<button class="sb-quantity-btn" onclick="minusQuantity(${response.cartItems[i].id}, '${response.cartItems[i].type}', ${response.cartItems[i].box})">-</button><span class="sb-quantity" id="quantity${response.cartItems[i].id}${response.cartItems[i].box}">${response.cartItems[i].quantity}</span>
                                                                                    <button class="sb-quantity-btn" onclick="plusQuantity(${response.cartItems[i].id}, '${response.cartItems[i].type}',${response.cartItems[i].box})">+</button>
                                                                                `;

                                        
                                        if(response.cartItems[i].type=="box")
                                        {
                                            cartItemsHTML+=`<span class="sb-quantity" id="quantity${response.cartItems[i].id}">&nbsp;&nbsp;`;
                                            let boxText = "Box";
                                            if(response.cartItems[i].box != 1)
                                            {
                                                boxText = "Boxes";
                                            }
                                            cartItemsHTML+=`${response.cartItems[i].box} ${boxText}</span>`;
                                        }
                                       
                                    // }
                                    // else
                                    // {
                                    //     cartItemsHTML += ` <span class="sb-quantity" id="quantity${response.cartItems[i].id}">${response.cartItems[i].quantity} Boxes</span>`;
                                    // }
                                                                            
                                    cartItemsHTML += `</div><button class="sb-remove-item btn btn-sm btn-outline-danger" onclick="deleteItemFromCart(${response.cartItems[i].id},'${response.cartItems[i].type}',${response.cartItems[i].box})">×</button></div>`;

                                        if(i==0)
                                        {
                                            totalAmount = response.totalPrice;
                                        }
                                    }
                                    $('.sb-cart-content').html(cartItemsHTML);
                                 }
                            }

                            if(adOnProducts.length == 0)
                            {
                                $('.sb-sidebar-overlay').attr('class','sb-sidebar-overlay sb-active');
                                $('.sb-cart-sidebar').attr('class','sb-cart-sidebar sb-active');
                                let cartCount = response.cartCount;
                                let iconURL = "{{ asset('assets/images/cart.svg')}}";
                                $('.cartbtn').html(`<img src="${iconURL}">${cartCount}`);

                                $('.sb-new-total').html('RM '+response.totalPrice);

                                updateProgressBar(freeShippingAmount, response.totalPrice);
                            }
                            // $('.sb-sidebar-overlay').attr('class','sb-sidebar-overlay sb-active');
                            // $('.sb-cart-sidebar').attr('class','sb-cart-sidebar sb-active');
                            // let cartCount = response.cartCount;
                            // let iconURL = "{{ asset('assets/images/cart.svg')}}";
                            // $('.cartbtn').html(`<img src="${iconURL}">${cartCount}`);

                            // $('.sb-new-total').html('RM '+response.totalPrice);

                            // updateProgressBar(freeShippingAmount, response.totalPrice);

                            let totalAdOnProducts;
                            if(adOnProducts.length>0)
                            {
                                totalAdOnProducts = adOnProducts.length;
                                for(let i=0; i<adOnProducts.length; i++)
                                {
                                    let adOnProductId = $(adOnProducts[i]).data('ad-on-product-id');
                                    let adOnProductPrice = $(adOnProducts[i]).data('ad-on-product-price');
                                    var adOnProductQuantity = 1;

                                     $.ajax({
                                        url: "{{ route('cart.add') }}",
                                        method: "POST",
                                        data: {
                                            _token: "{{ csrf_token() }}",
                                            product_id: adOnProductId,
                                            price: adOnProductPrice,
                                            quantity: adOnProductQuantity
                                            // number_of_boxes:numberOfBoxes
                                        },
                                        success:function(response)
                                        {
                                            // let cartItems = 
                                            if(totalAdOnProducts-i == 1)
                                            {
                                                 let cartItemsHTML1 = '';
                                                for(let j=0;j<response.cartItems.length;j++)
                                                {
                                                    let siteURL = "{{ url('/') }}"; 
                                                    let imageURL = siteURL+'/'+response.cartItems[j].image;
                                                    cartItemsHTML1 += `<div class="sb-cart-item">
                                                                        <img src="${imageURL}" alt="Curry Paste" class="sb-item-image">
                                                                        <div class="sb-item-details">
                                                                            <div class="sb-item-name">${response.cartItems[j].name}</div>
                                                                            <div class="sb-item-price">
                                                                                <div class="sb-original-price">
                                                                                    <!-- RM 220.80 -->
                                                                                    <span class="sb-discounted-price" style="margin-left:0px;">RM ${response.cartItems[j].price}</span></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="sb-quantity-controls">`;
                                            // if(response.cartItems[j].type == "product")
                                            // {
                                        cartItemsHTML1 += ` <button class="sb-quantity-btn" onclick="minusQuantity(${response.cartItems[j].id},'${response.cartItems[j].type}',${response.cartItems[j].box})">-</button>`;
                                        
                                        let box = response.cartItems[j].box;

                                        if(box == null)
                                        {
                                            box = "";
                                        }

                                        cartItemsHTML1+=`<span class="sb-quantity" id="quantity${response.cartItems[j].id}${box}">${response.cartItems[j].quantity}</span>
                                                                                <button class="sb-quantity-btn" onclick="plusQuantity(${response.cartItems[j].id},'${response.cartItems[j].type}',${response.cartItems[j].box})">+</button>
                                                                            `;

                                        if(response.cartItems[j].type=="box")
                                        {
                                            cartItemsHTML1+=`<span class="sb-quantity" id="quantity${response.cartItems[j].id}">&nbsp;&nbsp;`;
                                            let boxText = "Box";
                                            if(response.cartItems[j].box != 1)
                                            {
                                                boxText = "Boxes";
                                            }
                                            cartItemsHTML1+=`${response.cartItems[j].box} ${boxText}</span>`;
                                        }

                                      
                                        
                                            // }
                                            // else 
                                            // {
                                            //     cartItemsHTML1+=`<span class="sb-quantity" id="quantity${response.cartItems[j].id}">`;
                                                
                                            //     if(response.cartItems[j].quantity == "1")
                                            //     {
                                            //         cartItemsHTML1+=`${response.cartItems[j].quantity} Box`;
                                            //     }
                                            //     else
                                            //     {
                                            //         cartItemsHTML1+=`${response.cartItems[j].quantity} Boxes`;
                                            //     }

                                            //      cartItemsHTML1+=`</span>`;
                                            // }
                                                                               
                                                                    cartItemsHTML1 += `</div>
                                                                        <button class="sb-remove-item btn btn-sm btn-outline-danger" onclick="deleteItemFromCart(${response.cartItems[j].id},'${response.cartItems[j].type}',${response.cartItems[j].box})">×</button></div>`;

                                                                    // totalAmount = response.cartItems[i].totalPrice;
                                                                    if(j==0)
                                                                    {
                                                                         totalAmount1 = response.totalPrice; 
                                                                    }

                                                }

                                                 $('.sb-cart-content').html(cartItemsHTML1);
                                                //  totalAmount1 = response.totalPrice;
                                                
                                                 
                                                //  alert(response.totalPrice);
                                            }

                                           

                                            //  $('.sb-sidebar-overlay').attr('class','sb-sidebar-overlay sb-active');
                                            // $('.sb-cart-sidebar').attr('class','sb-cart-sidebar sb-active');
                                            // let cartCount = response.cartCount;
                                            // let iconURL = "{{ asset('assets/images/cart.svg')}}";
                                            // $('.cartbtn').html(`<img src="${iconURL}">${cartCount}`);

                                            // $('.sb-new-total').html('RM '+response.totalPrice);

                                            
                                            // updateProgressBar(freeShippingAmount, response.totalPrice);
                                        }
                                    })
                                    .then(response => {

                                            $('.sb-sidebar-overlay').attr('class','sb-sidebar-overlay sb-active');
                                            $('.sb-cart-sidebar').attr('class','sb-cart-sidebar sb-active');
                                            let cartCount = response.cartCount;
                                            let iconURL = "{{ asset('assets/images/cart.svg')}}";
                                            $('.cartbtn').html(`<img src="${iconURL}">${cartCount}`);

                                            $('.sb-new-total').html('RM '+response.totalPrice);
                                        updateProgressBar(freeShippingAmount,  response.totalPrice);
                                        // totalAmount1 = response.totalPrice;   // assign value here
                                    });
                                }
                            }

                                // $('.sb-sidebar-overlay').attr('class','sb-sidebar-overlay sb-active');
                                //             $('.sb-cart-sidebar').attr('class','sb-cart-sidebar sb-active');
                                //             let cartCount = response.cartCount;
                                //             let iconURL = "{{ asset('assets/images/cart.svg')}}";
                                //             $('.cartbtn').html(`<img src="${iconURL}">${cartCount}`);

                                //             $('.sb-new-total').html('RM '+totalAmount);

                                // alert(freeShippingAmount+" "+totalAmount1);
                                            
                                            // updateProgressBar(freeShippingAmount, totalAmount);


                            // else
                            // {
                            //         toastr.success('Please wait! Cart is being updated');
                            //     setTimeout(function(){
                            //         window.location.href = "{{ url('cart') }}";
                            //     },5000);
                            // }


                            // setTimeout(function()
                            // {

                            //     $('.sb-sidebar-overlay').attr('class','sb-sidebar-overlay sb-active');
                            // $('.sb-cart-sidebar').attr('class','sb-cart-sidebar sb-active');

                            // //  alert
                            // $('.sb-new-total').html('RM '+response.totalPrice);
                            // }, 5000);

                           


                        } else {
                            toastr.error('Failed to add item to cart.');
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        toastr.error('Error adding item to cart.');
                    }
                });

                
            });
</script>

@stop


