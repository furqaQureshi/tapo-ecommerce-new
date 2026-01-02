<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductBundle;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ProductBundleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_bundles = ProductBundle::paginate('10');
        return view('admin.productbundle.index', compact('product_bundles'));
    }

    public function get(Request $request)
    {
        return DataTables::of(ProductBundle::query())
            ->addIndexColumn()
            ->addColumn('month_of', function ($productBundle) {
                return getMonthName($productBundle->month_of ?? '-');
            })
            ->addColumn('products', function ($productBundle) {
                return !empty($productBundle->product_names) ? implode(', ', $productBundle->product_names) : '-';
            })
            ->addColumn('action', function ($productBundle) {
                return '
                    <a href="' . route('product-bundle.edit', $productBundle->id) . '" class="action_btn edit-item" title="Edit"><i class="ri ri-edit-line"></i></a>
                    <button class="action_btn delete-item dltBtn" data-id="' . $productBundle->id . '" title="Delete"><i class="ri ri-delete-bin-line"></i></button>
                ';
            })
            ->rawColumns(['products', 'action'])
            ->make(true);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('is_subscription', 1)->get(['id', 'name']);
        return view('admin.productbundle.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'month_of' => 'required',
            'product_ids.*' => 'exists:products,id',
        ], [
            'product_ids.max' => 'You can select a maximum of 8 products.',
            'product_ids.min' => 'You must select at least 4 products.',
        ]);

        $alreadyBooked = ProductBundle::where('month_of', $request->month_of)->exists();

        if ($alreadyBooked) {
            return redirect()->back()->with('error', 'You have already booked products for this month.');
        }

        $bundle = new ProductBundle();
        $bundle->month_of = $request->month_of;
        $bundle->product_ids = $request->product_ids;
        $bundle->save();

        $message = $bundle
            ? 'Product Bundle Successfully added'
            : 'Please try again!!';

        return redirect()->route('product-bundle.index')->with(
            $bundle ? 'success' : 'error',
            $message
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Implement if needed
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bundle = ProductBundle::findOrFail($id);
        $products = Product::where('is_subscription', 1)->get(['id', 'name']);
        return view('admin.productbundle.edit', compact('bundle', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Log::info('Update request data', ['product_ids' => $request->product_ids]);
        $validated = $request->validate([
            'month_of' => 'required|string|in:01,02,03,04,05,06,07,08,09,10,11,12',
            'product_ids' => 'required',
            'product_ids.*' => 'exists:products,id',
        ]);

        $bundle = ProductBundle::findOrFail($id);
        $bundle->update([
            'month_of' => $validated['month_of'],
            'product_ids' => $validated['product_ids'],
        ]);

        return redirect()->route('product-bundle.index')->with('success', 'Product Bundle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bundle = ProductBundle::findOrFail($id);
        $status = $bundle->delete();

        $message = $status
            ? 'Product Bundle successfully deleted'
            : 'Error while deleting product';

        return redirect()->route('product-bundle.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }
}
