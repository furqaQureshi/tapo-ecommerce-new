<div class="row g-4" id="default-products">
    @if (count($products) > 0)
        @foreach ($products as $product)
            @php
                $priceData =
                    auth()->check() && auth()->user()->account_type === 'reseller'
                        ? product_price_range($product)
                        : normal_product_price_range($product);
                $firstImage = $product->media->first();
                $imageSrc = $firstImage
                    ? asset($firstImage->image_path)
                    : ($product->featured_image
                        ? asset($product->featured_image)
                        : asset('assets/img/product/01.jpg'));
            @endphp
            <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".{{ 2 + ($loop->index % 8) * 2 }}s">
                <div class="product-collection-item">
                    <a href="{{ route('product.detail', $product->slug) }}">
                        <div class="product-image">
                            <img src="{{ $imageSrc }}" alt="{{ $product->name }}">
                            <div class="d-flex justify-content-between">
                                @if ($priceData['discount_percentage'] > 0)
                                    <div class="badge badge-discount">{{ $priceData['discount_percentage'] }}%</div>
                                @endif
                                {{-- @if ($product->label === 'zeera_pick')
                                    <div class="badge badge-warning">Zeera Pick</div>
                                @elseif ($product->label === 'addon' && $product->addon_price)
                                    <div class="badge badge-danger">+RM{{ number_format($product->addon_price, 2) }}</div>
                                @endif --}}
                            </div>
                            <div class="product-btn">
                                @if ($product->qty > 0)
                                    @if (!empty($product->attributes) && count($product->attributes) > 0)
                                        <a href="{{ route('product.detail', $product->slug) }}" class="theme-btn-2">
                                            {{ __('lang.go_to') }}
                                        </a>
                                    @else
                                        <a href="javascript:void(0);" class="theme-btn-2 add-to-cart-btn"
                                            data-product-id="{{ $product->id }}"
                                            data-price="{{ $product->price - ($product->price * ($product->discount ?? 0)) / 100 }}"
                                            id="addToCartBtn-{{ $product->id }}">
                                            {{ __('lang.Add_to_cart') }}
                                        </a>
                                    @endif
                                @else
                                    <a href="javascript:void(0);" class="theme-btn-2 disabled-link">
                                        {{ __('lang.out_of_stock') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </a>
                    <div class="product-content">
                        <p>{{ __('lang.stock') }} <b>{{ $product->qty }}</b> {{ __('lang.available') }}</p>
                        <h4>
                            <a href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a>
                        </h4>
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
            </div>
        @endforeach
    @else
        <h4 class="text-warning" style="margin:100px auto;">{{ __('lang.there_are_no_products') }}</h4>
    @endif
</div>
<div id="filtered-products" class="row g-4"></div>
@if ($products->lastPage() > 1)
    <div class="page-nav-wrap">
        <ul>
            @if ($products->onFirstPage())
                <li><span class="page-numbers disabled"><i class="fa-solid fa-arrow-left-long"></i></span></li>
            @else
                <li><a class="page-numbers" href="{{ $products->previousPageUrl() }}"><i
                            class="fa-solid fa-arrow-left-long"></i></a></li>
            @endif
            @for ($i = 1; $i <= $products->lastPage(); $i++)
                <li class="{{ $i == $products->currentPage() ? 'active' : '' }}">
                    <a class="page-numbers" href="{{ $products->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            @if ($products->hasMorePages())
                <li><a class="page-numbers" href="{{ $products->nextPageUrl() }}"><i
                            class="fa-solid fa-arrow-right-long"></i></a></li>
            @else
                <li><span class="page-numbers disabled"><i class="fa-solid fa-arrow-right-long"></i></span></li>
            @endif
        </ul>
    </div>
@endif

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
