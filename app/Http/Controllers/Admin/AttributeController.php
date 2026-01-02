<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    public function list()
    {
        return view('admin.attributes.index');
    }

    public function get(Request $request)
    {
        if ($request->ajax()) {
            $data = Attribute::select(['id', 'name', 'status']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('status', function ($row) {
                    $checked = $row->status ? 'checked' : '';
                    return '<input type="checkbox" class="status" data-id="' . $row->id . '" ' . $checked . '>';
                })
                ->addColumn('actions', function ($row) {
                    return '
                        <a href="' . route('admin.attribute.edit', $row->id) . '" class="action_btn edit-item"><i class="ri-edit-line"></i></a>
                        <button class="action_btn delete-btn" data-id="' . $row->id . '" ><i class="bx bx-trash"></i></button>
                    ';
                })
                ->rawColumns(['name', 'status', 'actions'])
                ->make(true);
        }
    }

    public function create()
    {
        return view('admin.attributes.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Attribute::create($request->all());
        return redirect()->route('admin.attributes.list')->with('success', 'Attribute created successfully');
    }

    public function edit($id)
    {
        $category = Attribute::findOrFail($id);
        return view('admin.attributes.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = Attribute::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('admin.attributes.list')->with('success', 'Attribute updated successfully');
    }

    public function destroy($id)
    {
        Attribute::findOrFail($id)->delete();
        return response()->json(['success' => 'Attribute deleted successfully']);
    }

    public function updateStatus(Request $request, $id)
    {
        $category = Attribute::findOrFail($id);
        $category->status = $request->status;
        $category->save();
        return response()->json(['success' => 'Status updated successfully']);
    }
}
