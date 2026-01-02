<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\MonthlyProduct;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class MonthlyProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monthly_products = MonthlyProduct::paginate('10');
        return view('admin.monthlyproducts.index', compact('monthly_products'));
    }

    public function get(Request $request)
    {
        return DataTables::of(MonthlyProduct::query())
            ->addIndexColumn()
            ->addColumn('month_of', function ($productMonthly) {
                return getMonthName($productMonthly->month_of ?? '-');
            })
            ->addColumn('products', function ($productMonthly) {
                return !empty($productMonthly->product_names) ? implode(', ', $productMonthly->product_names) : '-';
            })
            ->addColumn('action', function ($productMonthly) {
                return '
                    <a href="' . route('monthly-product.page', strtolower(getMonthName($productMonthly->month_of))) . '" class="action_btn" title="view" target="_blank"><i class="ri-link"></i></a>
                    <a href="' . route('monthly-product.edit', $productMonthly->id) . '" class="action_btn edit-item" title="Edit"><i class="ri ri-edit-line"></i></a>
                    <button class="action_btn delete-item dltBtn" data-id="' . $productMonthly->id . '" title="Delete"><i class="ri ri-delete-bin-line"></i></button>
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
        $products = Product::where('is_subscription', 0)->get(['id', 'name']);
        return view('admin.monthlyproducts.create', compact('products'));
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

        $alreadyBooked = MonthlyProduct::where('month_of', $request->month_of)->exists();

        if ($alreadyBooked) {
            return redirect()->back()->with('error', 'You have already booked products for this month.');
        }

        $bundle = new MonthlyProduct();
        $bundle->month_of = $request->month_of;
        $bundle->product_ids = $request->product_ids;
        $bundle->save();

        $message = $bundle
            ? 'Monthly Products Successfully added'
            : 'Please try again!!';

        return redirect()->route('monthly-product.index')->with(
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
        $bundle = MonthlyProduct::findOrFail($id);
        $products = Product::where('is_subscription', 0)->get(['id', 'name']);
        return view('admin.monthlyproducts.edit', compact('bundle', 'products'));
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

        $bundle = MonthlyProduct::findOrFail($id);
        $bundle->update([
            'month_of' => $validated['month_of'],
            'product_ids' => $validated['product_ids'],
        ]);

        return redirect()->route('monthly-product.index')->with('success', 'Monthly Products updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bundle = MonthlyProduct::findOrFail($id);
        $status = $bundle->delete();

        $message = $status
            ? 'Monthly Products successfully deleted'
            : 'Error while deleting product';

        return redirect()->route('monthly-product.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }
}
