<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class BlogCategoryController extends Controller
{
    public function index()
    {
        return view('admin.blog_categories.index');
    }

    public function getCategories(Request $request)
    {
        if ($request->ajax()) {
            $data = BlogCategory::select(['id', 'name', 'status']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $checked = $row->status ? 'checked' : '';
                    return '<input type="checkbox" class="status" data-id="' . $row->id . '" ' . $checked . '>';
                })
                ->addColumn('actions', function ($row) {
                    return '
                        <a href="' . route('admin.blogcategory.edit', $row->id) . '" class="action_btn edit-item"><i class="ri-edit-line"></i></a>
                        <button class="action_btn delete-item" data-id="' . $row->id . '" ><i class="bx bx-trash"></i></button>
                    ';
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }
    }

    public function create()
    {
        return view('admin.blog_categories.create');
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

        BlogCategory::create($request->all());
        return redirect()->route('admin.blogcategories.index')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $category = BlogCategory::findOrFail($id);
        return view('admin.blog_categories.edit', compact('category'));
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

        $category = BlogCategory::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('admin.blogcategories.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        BlogCategory::findOrFail($id)->delete();
        return response()->json(['success' => 'Category deleted successfully']);
    }

    public function updateStatus(Request $request, $id)
    {
        $category = BlogCategory::findOrFail($id);
        $category->status = $request->status;
        $category->save();
        return response()->json(['success' => 'Status updated successfully']);
    }
}
