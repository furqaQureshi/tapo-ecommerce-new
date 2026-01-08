<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\DeliveryInterval;

class DeliveryIntervalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin|staff']);
    }

    public function list()
    {
        return view('admin.delivery-intervals.list');
    }

    public function get(Request $request)
    {
        if ($request->ajax()) {
            $data = DeliveryInterval::select('delivery_intervals.*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.delivery-interval.edit', $row->id);
                    $deleteUrl = route('admin.delivery-interval.destroy', $row->id);
                    $csrf = csrf_field();
                    $method = method_field('DELETE');

                    $html = '<div style="display:flex; gap:8px;">'
                        . '<a href="' . $editUrl . '" class="action_btn edit-item"><i class="ri-edit-line"></i></a>'
                        . '<form method="POST" action="' . $deleteUrl . '" style="display:inline;">' . $csrf . $method
                        . '<button type="submit" class="action_btn delete-item show_confirm" data-name="Delivery Interval"><i class="bx bx-trash"></i></button>'
                        . '</form></div>';

                    return $html;
                })
                ->addColumn('default', function ($row) {
                    return $row->is_default ? '<span class="badge bg-success">Default</span>' : '';
                })
                ->rawColumns(['action', 'default'])
                ->make(true);
        }
    }

    public function add()
    {
        return view('admin.delivery-intervals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'weeks' => 'required|integer|min:1|unique:delivery_intervals,weeks',
            'is_default' => 'nullable|in:0,1',
        ]);

        if ($request->is_default) {
            DeliveryInterval::query()->update(['is_default' => false]);
        }

        DeliveryInterval::create([
            'name' => $request->name,
            'weeks' => $request->weeks,
            'is_default' => $request->is_default ? true : false,
        ]);

        return redirect()->route('admin.delivery-interval.list')->with('success', 'Delivery interval created successfully.');
    }

    public function edit($id)
    {
        $interval = DeliveryInterval::findOrFail($id);
        return view('admin.delivery-intervals.edit', compact('interval'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'weeks' => 'required|integer|min:1|unique:delivery_intervals,weeks,' . $id,
            'is_default' => 'nullable|in:0,1',
        ]);

        $interval = DeliveryInterval::findOrFail($id);

        if ($request->is_default) {
            DeliveryInterval::query()->update(['is_default' => false]);
        }

        $interval->update([
            'name' => $request->name,
            'weeks' => $request->weeks,
            'is_default' => $request->is_default ? true : false,
        ]);

        return redirect()->route('admin.delivery-interval.list')->with('success', 'Delivery interval updated successfully.');
    }

    public function destroy($id)
    {
        $interval = DeliveryInterval::findOrFail($id);
        $interval->delete();

        return redirect()->route('admin.delivery-interval.list')->with('success', 'Delivery interval deleted successfully.');
    }
}
