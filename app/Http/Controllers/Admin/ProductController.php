<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\APIService;
use Illuminate\Support\Str;
use App\Models\ProductMedia;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\ProductAffiliate;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\AddOnProduct;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function list()
    {
        $settings = Setting::first();
        if (!$settings) {
            $settings = new Setting();
            $settings->product_margin = config('app.product_margin');
            $settings->save();
        }
        return view('admin.products.list', compact('settings'));
    }

    public function get(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with(['variants'])
                ->withCount('variants')
                ->select('products.*')->orderBy('id','DESC');
            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('name', function ($product) {
                    return '<span>' . $product->name . '</span>';
                })
                ->addColumn('image', function ($product) {
                    $firstImage = $product->media->first();
                    return $firstImage && file_exists(public_path($firstImage->image_path))
                        ? '<img src="' . asset($firstImage->image_path) . '" width="50" class="table-image" />'
                        : '<div class="user-name-avatar">' . usernameAvatar($product->name) . '</div>';
                })

                ->addColumn('categories', function ($product) {
                    return $product->categories->pluck('name')->implode(', ') ?: 'N/A';
                })



                ->addColumn('price_range', function ($product) {
                    $prices = $product->variants->pluck('price');
                    if ($prices->isEmpty()) return 'N/A';
                    $min = number_format($prices->min(), 2);
                    $max = number_format($prices->max(), 2);
                    return $min === $max ? "RM $min" : "RM $min - RM $max";
                })
                ->addColumn('price', function ($product) {
                    return $product->price ? 'RM ' . number_format($product->price, 2) : 'N/A';
                })
                ->addColumn('qty', function ($product) {
                    return 'Stock: '.$product->qty;
                })

                ->addColumn('status', function ($product) {
                    return ucfirst($product->status);
                })

                ->addColumn('action', function ($product) {
                    return Blade::render('
                        <div style="display: flex; gap: 8px;">
                            @hasRoutePermission("admin.product.edit")
                                <a href="{{ route("admin.product.edit", $product->id) }}" class="action_btn edit-item">
                                    <i class="ri-edit-line"></i>
                                </a>
                            @endhasRoutePermission
                            @hasRoutePermission("admin.product.destroy")
                                <form method="POST" action="{{ route("admin.product.destroy", $product->id) }}" style="display:inline;">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="action_btn delete-item show_confirm" data-name="Product">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            @endhasRoutePermission
                            @if (!auth()->user()->hasPermissionTo(\App\Services\PermissionMap::getPermission("admin.product.edit")) &&
                                !auth()->user()->hasPermissionTo(\App\Services\PermissionMap::getPermission("admin.product.destroy")))
                                <span>-</span>
                            @endif
                        </div>
                    ', ['product' => $product]);
                })
                ->addColumn('published_date', function ($product) {
                    return runTimeDateFormat($product->created_at);
                })

                ->filterColumn('categories', function ($query, $keyword) {
                    $query->whereHas('categories', function ($q) use ($keyword) {
                        $q->whereRaw('LOWER(name) LIKE ?', ["%" . strtolower($keyword) . "%"]);
                    });
                })


                ->filterColumn('price', function ($query, $keyword) {
                    $query->where('price', 'LIKE', "%$keyword%");
                })

                ->filterColumn('price_range', function ($query, $keyword) {
                    $query->whereHas('variants', function ($q) use ($keyword) {
                        $q->whereRaw('price LIKE ?', ["%$keyword%"]);
                    });
                })
                ->filterColumn('status', function ($query, $keyword) {
                    $query->whereRaw('LOWER(status) LIKE ?', ["%" . strtolower($keyword) . "%"]);
                })

                ->filterColumn('name', function ($query, $keyword) {
                    $query->whereRaw('LOWER(name) LIKE ?', ["%" . strtolower($keyword) . "%"]);
                })
                ->filterColumn('published_date', function ($query, $keyword) {
                    $query->where(function ($q) use ($keyword) {
                        $q->whereDate('products.created_at', $keyword)
                            ->orWhereRaw("DATE_FORMAT(products.created_at, '%Y-%m-%d') LIKE ?", ["%{$keyword}%"])
                            ->orWhereRaw("DATE_FORMAT(products.created_at, '%d-%m-%Y') LIKE ?", ["%{$keyword}%"])
                            ->orWhereRaw("DATE_FORMAT(products.created_at, '%M') LIKE ?", ["%{$keyword}%"]);
                    });
                })

                ->orderColumn('source', function ($query, $order) {
                    $query->orderBy('source', $order);
                })

                ->orderColumn('categories', function ($query, $order) {
                    $query->leftJoin('product_category', 'products.id', '=', 'product_category.product_id')
                        ->leftJoin('categories', 'product_category.category_id', '=', 'categories.id')
                        ->select('products.*', \DB::raw('GROUP_CONCAT(categories.name SEPARATOR ", ") as category_names'))
                        ->groupBy('products.id')
                        ->orderBy('category_names', $order);
                })


                ->orderColumn('price', function ($query, $order) {
                    $query->orderBy('price', $order);
                })


                ->orderColumn('price_range', function ($query, $order) {
                    $query->leftJoin('product_variants as pv', 'products.id', '=', 'pv.product_id')
                        ->select('products.*', DB::raw('MIN(pv.price) as min_price'))
                        ->groupBy('products.id')
                        ->orderBy('min_price', $order);
                })
                ->orderColumn('name', function ($query, $order) {
                    $query->select('products.*')->orderBy('products.name', $order);
                })

                ->orderColumn('status', function ($query, $order) {
                    $query->select('products.*')->orderBy('products.status', $order);
                })
                ->orderColumn('published_date', function ($query, $order) {
                    $query->orderBy('products.created_at', $order);
                })


                ->rawColumns(['name', 'image', 'published_date', 'action'])
                ->make(true);
        }
    }


    public function add()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        $attributes = Attribute::where('status', 1)->get();
        $products = Product::select('id','name')->get();
        return view('admin.products.create', compact('categories', 'attributes', 'products'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:products,slug',
            'category_ids' => 'required|array|min:1',
            'category_ids.*' => 'exists:categories,id',
            'status' => 'required|in:active,inactive,draft',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,jpg,png,webp|max:10240',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|numeric|min:0',
            'addon_price' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'label' => 'nullable|in:normal,zeera_pick,addon',
        ], [
            'images.required' => 'At least one image is required.',
            'images.*.image' => 'Each uploaded file must be an image.',
            'images.*.mimes' => 'Each image must be a JPEG, JPG, PNG, or WEBP file.',
            'images.*.max' => 'Each image must not exceed 10MB.',
            'category_ids.required' => 'At least one category is required.',
            'category_ids.*.exists' => 'One or more selected categories are invalid.',
        ]);

        // dd($request->all());


        try {
            DB::beginTransaction();

            $variantQties = 0;
            $attributeQties = 0;

            // Create product
            $product = new Product();
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->status = $request->status;
            // $product->is_featured = $request->has('is_featured') ? 1 : 0;
            // $product->is_e_ticket = $request->has('is_e_ticket') ? 1 : 0;
            // $product->short_description = $request->short_description;
            // $product->description = $request->description;
            $product->price = $request->price;
            $product->qty = $request->qty;
            // $product->addon_price = $request->addon_price;
            $product->discount = $request->discount ?? 0;
            // $product->is_affiliate = $request->has('is_affiliate') ? 1 : 0;
            // $product->is_shop_product = $request->has('is_shop_product') ? 1 : 0;
            $product->is_subscription = $request->has('is_subscription') ? 1 : 0;
            // $product->label = $request->label;
            // $product->points = $request->points;
            // $product->redeem_points = $request->redeem_points;
            $product->category_ids = $request->category_ids;
            $product->box_price_2_discount = $request->box_price_2_discount;
            $product->box_price_3_discount = $request->box_price_3_discount;
            $product->sku = $request->sku;
            $product->save();

            // Handle images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    if ($image->isValid()) {
                        $imageName = $request->slug . '_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        $imagePath = public_path('product/images/');
                        $image->move($imagePath, $imageName);

                        ProductMedia::create([
                            'product_id' => $product->id,
                            'image_path' => 'product/images/' . $imageName,
                        ]);
                    }
                }
            }

            if(!empty($request->add_on_product_ids))
            {
                foreach($request->add_on_product_ids as $addOnProduct)
                {
                    AddOnProduct::create([
                        'add_on_product_id'=>$addOnProduct,
                        'product_id'=>$product->id
                    ]);
                }
            }


            // // Handle attributes
            // $attributeID = $request->input('attribute_id', []);
            // $attributeQties = 0;


            // if (is_array($attributeID) && count(array_filter($attributeID)) > 0) {
            //     foreach ($attributeID as $index => $value) {
            //         // Require both id and value to be filled
            //         if (empty($value) || empty($request->attribute_value[$index])) {
            //             continue;
            //         }

            //         ProductAttribute::create([
            //             'product_id'      => $product->id,
            //             'attribute_id'    => $value,
            //             'attribute_value' => $request->attribute_value[$index],
            //             'price'           => $request->attribute_price[$index] ?? 0,
            //             'discount'        => $request->attribute_discount[$index] ?? 0,
            //             'qty'             => $request->attribute_qty[$index] ?? 0,
            //         ]);

            //         $attributeQties += (int) ($request->attribute_qty[$index] ?? 0);
            //     }

            //     $product->qty = $attributeQties > 0 ? $attributeQties : $request->qty;
            //     $product->save();
            // }

            // Handle variants
            // $variantNames = $request->variant_name;
            // if (is_array($variantNames)) {
            //     foreach ($variantNames as $index => $name) {
            //         ProductVariant::create([
            //             'product_id' => $product->id,
            //             'name' => $name,
            //             'sku' => $request->variant_sku[$index] ?? null,
            //             'variant_qty' => $request->variant_qty[$index] ?? 0,
            //             'region' => $request->variant_region[$index] ?? null,
            //             'denomination' => $request->variant_denomination[$index] ?? null,
            //             'price' => $request->variant_price[$index] ?? 0,
            //             'order' => $request->variant_order[$index] ?? $index,
            //             'status' => 'active'
            //         ]);

            //         $variantQties += $request->variant_qty[$index] ?? 0;
            //     }

            //     $product->qty = $variantQties;
            //     $product->save();
            // }

            // Handle affiliates
            // if ($request->has('is_affiliate') && $request->has('affiliate_title') && $request->has('affiliate_link')) {
            //     foreach ($request->affiliate_title as $index => $title) {
            //         $link = $request->affiliate_link[$index];
            //         if (Str::startsWith($link, ['http://', 'https://'])) {
            //             ProductAffiliate::create([
            //                 'product_id' => $product->id,
            //                 'title' => $title,
            //                 'link' => $link,
            //             ]);
            //         }
            //     }
            // }

            DB::commit();

            return redirect()->route('admin.products.list')->with('success', 'Request has been completed');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Product creation failed: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return back()->withErrors(['error' => 'Something went wrong, please try again.']);
        }
    }

    public function edit($id)
    {
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->get();
        $product = Product::find($id);
        $affiliate_titles = ProductAffiliate::where('product_id', $id)->pluck('title')->toArray();
        $affiliate_links = ProductAffiliate::where('product_id', $id)->pluck('link')->toArray();
        $attributes = Attribute::where('status', 1)->get();
        $products = Product::with('addOnProducts')->select('id','name')->get();
        $productSku = $product->sku;
        // return $product;
        return view('admin.products.edit', compact('categories', 'product', 'affiliate_titles', 'affiliate_links', 'attributes', 'products','productSku'));
    }

    // public function update(Request $request, $id)
    // {
    //     $product = Product::findOrFail($id);

    //     $request->validate([
    //         'name' => 'required|string',
    //         'slug' => 'required|string|unique:products,slug,' . $product->id,
    //         'category_ids' => 'required|array|min:1',
    //         'category_ids.*' => 'exists:categories,id',
    //         'status' => 'required|in:active,inactive,draft',
    //         'short_description' => 'nullable|string',
    //         'description' => 'nullable|string',
    //         'images' => 'nullable|array',
    //         'images.*' => 'image|mimes:jpeg,jpg,png,webp|max:10240',
    //         'price' => 'required|numeric|min:0',
    //         'qty' => 'required|numeric|min:0',
    //         'addon_price' => 'nullable|numeric|min:0',
    //         'discount' => 'nullable|numeric|min:0|max:100',
    //         'label' => 'nullable|in:normal,zeera_pick,addon',
    //     ], [
    //         'images.*.image' => 'Each uploaded file must be an image.',
    //         'images.*.mimes' => 'Each image must be a JPEG, JPG, PNG, or WEBP file.',
    //         'images.*.max' => 'Each image must not exceed 10MB.',
    //         'category_ids.required' => 'At least one category is required.',
    //         'category_ids.*.exists' => 'One or more selected categories are invalid.',
    //     ]);

    //     if ($request->type == 'auto' && !$request->has('api_services')) {
    //         return redirect()->back()
    //             ->with('error', 'Supplier can not be empty on product type auto')
    //             ->withInput();
    //     }

    //     // Update product basic info
    //     $product->name = $request->name;
    //     $product->slug = $request->slug;
    //     $product->type = $request->type;
    //     $product->status = $request->status;
    //     $product->price = $request->price;
    //     $product->qty = $request->qty; // will be overridden if variants exist
    //     $product->addon_price = $request->addon_price;
    //     $product->is_featured = $request->has('is_featured') ? 1 : 0;
    //     $product->short_description = $request->short_description;
    //     $product->description = $request->description;
    //     $product->is_affiliate = $request->has('is_affiliate') ? 1 : 0;
    //     $product->is_subscription = $request->has('is_subscription') ? 1 : 0;
    //     $product->discount = $request->discount ?? 0;
    //     $product->label = $request->label;
    //     $product->points = $request->points;
    //     $product->category_ids = $request->category_ids;
    //     $product->save();

    //     // Handle images
    //     if ($request->hasFile('images')) {
    //         foreach ($request->file('images') as $index => $image) {
    //             if ($image->isValid()) {
    //                 $imageName = $request->slug . '_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    //                 $imagePath = public_path('product/images/');
    //                 $image->move($imagePath, $imageName);

    //                 ProductMedia::create([
    //                     'product_id' => $product->id,
    //                     'image_path' => 'product/images/' . $imageName,
    //                 ]);
    //             }
    //         }
    //     }

    //     // Handle auto type suppliers
    //     if ($product->type == 'auto') {
    //         $api_services = $request->api_services ?? [];
    //         $product->apiServices()->sync($api_services);
    //     }

    //     // Handle variants
    //     $variantIds = $request->variant_id;
    //     $variantNames = $request->variant_name;
    //     $variantSkus = $request->variant_sku;
    //     $variantQty = $request->variant_qty;
    //     $variantRegions = $request->variant_region;
    //     $variantDenominations = $request->variant_denomination;
    //     $variantPrices = $request->variant_price;
    //     $variantOrders = $request->variant_order;

    //     $updatedVariantIds = [];
    //     $variantQties = 0;

    //     if (is_array($variantNames)) {
    //         foreach ($variantNames as $index => $name) {
    //             $variantId = $variantIds[$index] ?? null;
    //             $qty = $variantQty[$index] ?? 0;

    //             $data = [
    //                 'product_id' => $product->id,
    //                 'name' => $name,
    //                 'sku' => $variantSkus[$index] ?? null,
    //                 'variant_qty' => $qty,
    //                 'region' => $variantRegions[$index] ?? null,
    //                 'denomination' => $variantDenominations[$index] ?? null,
    //                 'price' => $variantPrices[$index] ?? 0,
    //                 'order' => $variantOrders[$index] ?? $index,
    //                 'status' => 'active',
    //             ];

    //             if ($variantId) {
    //                 $variant = ProductVariant::find($variantId);
    //                 if ($variant) {
    //                     $variant->update($data);
    //                     $updatedVariantIds[] = $variantId;
    //                 }
    //             } else {
    //                 $variant = ProductVariant::create($data);
    //                 $updatedVariantIds[] = $variant->id;
    //             }

    //             $variantQties += $qty;
    //         }

    //         // Delete removed variants
    //         ProductVariant::where('product_id', $product->id)
    //             ->whereNotIn('id', $updatedVariantIds)
    //             ->delete();

    //         // Update product qty with total variant quantities
    //         $product->qty = $variantQties;
    //         $product->save();
    //     }

    //     // Handle affiliates
    //     ProductAffiliate::where('product_id', $id)->delete();
    //     if ($request->has('is_affiliate') && $request->has('affiliate_title') && $request->has('affiliate_link')) {
    //         foreach ($request->affiliate_title as $index => $title) {
    //             $link = $request->affiliate_link[$index];
    //             if (!empty($title) && !empty($link) && Str::startsWith($link, ['http://', 'https://'])) {
    //                 ProductAffiliate::create([
    //                     'product_id' => $id,
    //                     'title' => $title,
    //                     'link' => $link,
    //                 ]);
    //             }
    //         }
    //     }

    //     return redirect()->route('admin.products.list')->with('success', 'Request has been completed');
    // }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:products,slug,' . $product->id,
            'category_ids' => 'required|array|min:1',
            'category_ids.*' => 'exists:categories,id',
            'status' => 'required|in:active,inactive,draft',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,jpg,png,webp|max:10240',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|numeric|min:0',
            'addon_price' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'label' => 'nullable|in:normal,zeera_pick,addon',
        ], [
            'images.*.image' => 'Each uploaded file must be an image.',
            'images.*.mimes' => 'Each image must be a JPEG, JPG, PNG, or WEBP file.',
            'images.*.max' => 'Each image must not exceed 10MB.',
            'category_ids.required' => 'At least one category is required.',
            'category_ids.*.exists' => 'One or more selected categories are invalid.',
        ]);

        if ($request->type == 'auto' && !$request->has('api_services')) {
            return redirect()->back()
                ->with('error', 'Supplier can not be empty on product type auto')
                ->withInput();
        }

        // DB::beginTransaction();

        try {
            // Update product basic info
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->type = $request->type;
            $product->status = $request->status;
            $product->price = $request->price;
            $product->qty = $request->qty; // will be overridden if variants exist
            $product->addon_price = $request->addon_price;
            $product->is_featured = $request->has('is_featured') ? 1 : 0;
            $product->is_e_ticket = $request->has('is_e_ticket') ? 1 : 0;
            $product->short_description = $request->short_description;
            $product->description = $request->description;
            $product->is_affiliate = $request->has('is_affiliate') ? 1 : 0;
            // $product->is_shop_product = $request->has('is_shop_product') ? 1 : 0;
            $product->is_subscription = $request->has('is_subscription') ? 1 : 0;
            $product->discount = $request->discount ?? 0;
            $product->label = $request->label;
            $product->points = $request->points;
            $product->category_ids = $request->category_ids;
            $product->box_price_2_discount = $request->box_price_2_discount;
            $product->box_price_3_discount = $request->box_price_3_discount;
            $product->sku = $request->sku;
            $product->save();

            // if(!empty($request->add_on_product_ids))
            // {
                AddOnProduct::where('product_id', $id)->delete();
                if(!empty($request->add_on_product_ids))
                {
                     foreach($request->add_on_product_ids as $addOnProduct)
                    {
                        AddOnProduct::create([
                            'add_on_product_id'=>$addOnProduct,
                            'product_id'=>$id
                        ]);
                    }
                }
               
            // }


            // Handle images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    if ($image->isValid()) {
                        $imageName = $request->slug . '_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        $imagePath = public_path('product/images/');
                        $image->move($imagePath, $imageName);

                        ProductMedia::create([
                            'product_id' => $product->id,
                            'image_path' => 'product/images/' . $imageName,
                        ]);
                    }
                }
            }

            // Handle auto type suppliers
            // if ($product->type == 'auto') {
            //     $api_services = $request->api_services ?? [];
            //     $product->apiServices()->sync($api_services);
            // }

            // Handle variants
            // $variantIds = $request->variant_id;
            // $variantNames = $request->variant_name;
            // $variantSkus = $request->variant_sku;
            // $variantQty = $request->variant_qty;
            // $variantRegions = $request->variant_region;
            // $variantDenominations = $request->variant_denomination;
            // $variantPrices = $request->variant_price;
            // $variantOrders = $request->variant_order;

            // $updatedVariantIds = [];
            // $variantQties = 0;

            // if (is_array($variantNames)) {
            //     foreach ($variantNames as $index => $name) {
            //         $variantId = $variantIds[$index] ?? null;
            //         $qty = $variantQty[$index] ?? 0;

            //         $data = [
            //             'product_id' => $product->id,
            //             'name' => $name,
            //             'sku' => $variantSkus[$index] ?? null,
            //             'variant_qty' => $qty,
            //             'region' => $variantRegions[$index] ?? null,
            //             'denomination' => $variantDenominations[$index] ?? null,
            //             'price' => $variantPrices[$index] ?? 0,
            //             'order' => $variantOrders[$index] ?? $index,
            //             'status' => 'active',
            //         ];

            //         if ($variantId) {
            //             $variant = ProductVariant::find($variantId);
            //             if ($variant) {
            //                 $variant->update($data);
            //                 $updatedVariantIds[] = $variantId;
            //             }
            //         } else {
            //             $variant = ProductVariant::create($data);
            //             $updatedVariantIds[] = $variant->id;
            //         }

            //         $variantQties += $qty;
            //     }

            //     // Delete removed variants
            //     ProductVariant::where('product_id', $product->id)
            //         ->whereNotIn('id', $updatedVariantIds)
            //         ->delete();

            //     // Update product qty with total variant quantities
            //     $product->qty = $variantQties;
            //     $product->save();
            // }

            // ProductAttribute::where('product_id', $product->id)->delete();
            // $attributeQties = 0;

            // // Now, re-insert attributes from request
            // if ($request->has('attribute_id') && is_array($request->attribute_id)) {
            //     foreach ($request->attribute_id as $index => $value) {
            //         // Skip if attribute_id or attribute_value is missing/empty
            //         if (empty($value) || empty($request->attribute_value[$index])) {
            //             continue;
            //         }

            //         ProductAttribute::create([
            //             'product_id'      => $product->id,
            //             'attribute_id'    => $value,
            //             'attribute_value' => $request->attribute_value[$index],
            //             'price'           => $request->attribute_price[$index] ?? 0,
            //             'discount'        => $request->attribute_discount[$index] ?? 0,
            //             'qty'             => $request->attribute_qty[$index] ?? 0,
            //         ]);

            //         $attributeQties += (int) ($request->attribute_qty[$index] ?? 0);
            //     }

            //     // Update product qty based on total attribute qty
            //     $product->qty = $attributeQties > 0 ? $attributeQties : $request->qty;
            //     $product->save();
            // }

            // Handle affiliates
            // ProductAffiliate::where('product_id', $id)->delete();
            // if ($request->has('is_affiliate') && $request->has('affiliate_title') && $request->has('affiliate_link')) {
            //     foreach ($request->affiliate_title as $index => $title) {
            //         $link = $request->affiliate_link[$index];
            //         if (!empty($title) && !empty($link) && Str::startsWith($link, ['http://', 'https://'])) {
            //             ProductAffiliate::create([
            //                 'product_id' => $id,
            //                 'title' => $title,
            //                 'link' => $link,
            //             ]);
            //         }
            //     }
            // }

            DB::commit();

            return redirect()->route('admin.products.list')->with('success', 'Request has been completed');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function deleteImage(Request $request)
    {
        $request->validate([
            'media_id' => 'required|exists:product_media,id',
        ]);

        $media = ProductMedia::find($request->media_id);
        if ($media && file_exists(public_path($media->image_path))) {
            unlink(public_path($media->image_path));
            $media->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Image not found or could not be deleted.']);
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->featured_image && file_exists(public_path($product->featured_image))) {
            unlink(public_path($product->featured_image));
        }

        ProductVariant::where('product_id', $product->id)->delete();
        ProductAttribute::where('product_id', $product->id)->delete();

        $product->delete();

        return redirect()->back()->with('success', 'Request has been completed');
    }

    public function setProductMargin(Request $request)
    {
        $settings = Setting::first();
        if (!$settings) {
            $settings = new Setting();
        }
        $settings->product_margin = $request->product_margin;
        $settings->save();
        return back()->with('success', 'Product Margin Updated!');
    }
}
