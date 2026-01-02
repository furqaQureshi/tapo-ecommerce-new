<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Review;
use App\Models\AppSetting;

class ProductController extends Controller
{
    public function __construct()
    {
        $freeShipping = AppSetting::where('variable','free_shipping')->first();
        view()->share('freeShippingPrice', $freeShipping->value);
    }

    public function show($slug)
    {
        $product = Product::with('media')->where('slug', $slug)->firstOrFail();

        $reviews = Review::where('product_id', $product->id)->with('user')->orderBy('id', 'DESC')->get();
        $relatedProducts = Product::where('category_id', $product->category_id)->where('status', 'active')
            ->where('id', '!=', $product->id)
            ->where('is_subscription', 0)
            ->inRandomOrder()
            ->take(4)
            ->get();

            $box2Price = $product->price*2;
            $box2DiscountPrice = 0;
            $box3Price = $product->price*3;
            $box3DiscountPrice = 0;

        if(!empty($product->box_price_2_discount))
        {
            $box2DiscountPrice = $box2Price -$product->box_price_2_discount;
            $box2Price = $box2Price-$box2DiscountPrice;
        }
        if(!empty($product->box_price_3_discount))
        {
            $box3DiscountPrice = $box3Price -$product->box_price_3_discount;
            $box3Price = $box3Price-$box3DiscountPrice;
        }
        return view('front.products.detail', compact('product', 'relatedProducts', 'reviews','box2Price','box2DiscountPrice','box3Price','box3DiscountPrice'));
    }

    public function autocomplete(Request $request)
    {
        $search = $request->get('term');

        $products = Product::where('name', 'like', '%' . $search . '%')
            ->limit(10)
            ->get(['name', 'slug', 'featured_image']);

        $results = [];

        foreach ($products as $product) {
            $results[] = [
                'name'  => $product->name,
                'slug'  => $product->slug,
                'image' => $product->featured_image
                    ? asset($product->featured_image)
                    : URL('front/assets/img/product/01.jpg'),
                'url'   => route('product.detail', $product->slug),
            ];
        }

        return response()->json($results);
    }

    public function ajaxFilter(Request $request)
    {
        $search = $request->query('search');
        $minPrice = $request->query('min_price') ?? ProductVariant::min('price');
        $maxPrice = $request->query('max_price') ?? ProductVariant::max('price');
        $categorySlug = $request->query('category');
        $ratings = $request->query('rating', []);


        $variantQuery = ProductVariant::query();

        if (!is_null($minPrice) && !is_null($maxPrice)) {
            $variantQuery->whereBetween('price', [(float)$minPrice, (float)$maxPrice]);
        }

        if ($search) {
            $variantQuery->whereHas('product', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }



        // if ($ratings) {
        //     $variantQuery->whereHas('product', function ($q) use ($ratings) {
        //         $q->whereIn('average_rating', $ratings);
        //     });
        // }

        $productIds = $variantQuery->pluck('product_id')->unique();

        $productsQuery = Product::whereIn('id', $productIds);

        if ($categorySlug) {
            $category = Category::where('slug', $categorySlug)->first();
            if ($category) {
                $productsQuery->where('category_id', $category->id);
            } else {
                $productsQuery->whereRaw('0 = 1');
            }
        }

        $products = $productsQuery->paginate(12);

        $html = view('front.components.filtered-products', compact('products'))->render();

        return response()->json(['html' => $html]);
    }
}
