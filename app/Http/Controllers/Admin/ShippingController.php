<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.shipping.index');
    }

    /**
     * Get data for DataTables.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Yajra\DataTables\DataTables
     */
    public function get(Request $request)
    {
        return DataTables::of(Shipping::query())
            ->addIndexColumn()
            ->addColumn('price', function ($shipping) {
                return $shipping->price !== null ? 'RM' . number_format($shipping->price, 2) : '-';
            })
            ->addColumn('status', function ($shipping) {
                return $shipping->status === 'active'
                    ? '<h5><span class="badge bg-success-subtle text-success fw-medium">' . ucfirst($shipping->status) . '</span></h5>'
                    : '<h5><span class="badge bg-warning-subtle text-warning fw-medium">' . ucfirst($shipping->status) . '</span></h5>';
            })
            ->addColumn('action', function ($shipping) {
                return '
                    <a href="' . route('shipping.edit', $shipping->id) . '" class="action_btn edit-item"  title="Edit"> <i class="ri-edit-line"></i></a>
                    <button class="action_btn delete-item dltBtn" data-id="' . $shipping->id . '"  title="Delete">       <i class="bx bx-trash"></i></button>
                ';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shipping.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        Log::info('Store shipping data', ['data' => $validated]);

        $status = Shipping::create($validated);

        return redirect()->route('shipping.index')->with([
            'success' => $status ? 'Shipping successfully created' : 'Error, please try again',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipping = Shipping::findOrFail($id);
        return view('admin.shipping.edit', compact('shipping'));
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
        $shipping = Shipping::findOrFail($id);

        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        Log::info('Update shipping data', ['id' => $id, 'data' => $validated]);

        $status = $shipping->update($validated);

        return redirect()->route('shipping.index')->with([
            'success' => $status ? 'Shipping successfully updated' : 'Error, please try again',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipping = Shipping::findOrFail($id);
        $status = $shipping->delete();

        return response()->json([
            'success' => $status ? 'Shipping successfully deleted' : 'Error, please try again',
        ]);
    }
}
