<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;

class CategoryController extends Controller
{
    public function list()
    {
        return view('admin.categories.list');
    }

    public function get(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::with('parent')->select('categories.*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('parent_category', function ($row) {
                    return $row->parent ? $row->parent->name : '-';
                })
                ->addColumn('status', function ($row) {
                    return Blade::render('
                        <div class="d-flex justify-content-center">
                            @hasRoutePermission("admin.category.status")
                                <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                    <input type="checkbox" class="form-check-input status" id="customSwitch-{{ $row->id }}"
                                        data-id="status" {{ $row->status == 1 ? "checked" : "" }}>
                                </div>
                            @else
                                <span>{{ $row->status == 1 ? "Active" : "Inactive" }}</span>
                            @endhasRoutePermission
                        </div>
                    ', ['row' => $row]);
                })
                ->addColumn('actions', function ($row) {
                    return Blade::render('
                        <div style="display: flex; justify-content: center; gap: 8px;">
                            @hasRoutePermission("admin.category.edit")
                                <a href="{{ route("admin.category.edit", $row->id) }}" class="action_btn edit-item">
                                    <i class="ri-edit-line"></i>
                                </a>
                            @endhasRoutePermission
                            @hasRoutePermission("admin.category.destroy")
                                <form method="POST" action="{{ route("admin.category.destroy", $row->id) }}" style="display:inline;">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="action_btn delete-item show_confirm" data-name="Category">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            @endhasRoutePermission
                            @if (!auth()->user()->hasPermissionTo(\App\Services\PermissionMap::getPermission("admin.category.edit")) && 
                                !auth()->user()->hasPermissionTo(\App\Services\PermissionMap::getPermission("admin.category.destroy"))))
                                <span>-</span>
                            @endif
                        </div>
                    ', ['row' => $row]);
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }
    }


    public function add()
    {
        $parent_categories = Category::whereNull('parent_id')->get();
        return view('admin.categories.create', compact('parent_categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'slug' => 'required|string|max:200|unique:categories,slug',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category = new Category();
        $category->unique_id = $this->generateUniqueCategoryId();
        $category->name = $validated['name'];
        $category->slug = $validated['slug'];
        $category->description = $request->description;
        $category->parent_id = $request->parent_id ?? null;
        $category->status = $request->has('status') ? 1 : 0;

        if ($request->image) {
            $featuredImage = $request->file('image');
            $featuredImageName = $request->slug . '_' . time() . '.' . $featuredImage->getClientOriginalExtension();
            $featuredImagePath = public_path('categories/image/');
            $featuredImage->move($featuredImagePath, $featuredImageName);

            $category->image = 'categories/image/' . $featuredImageName;
        }

        $category->save();

        return redirect()->route('admin.categories.list')->with('success', 'Request has been completed');
    }


    public function edit($id)
    {
        $category = Category::find($id);
        $parent_categories = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->get();
        return view('admin.categories.edit', compact('category', 'parent_categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'slug' => 'required|string|max:200|unique:categories,slug,' . $id,
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $validated['name'];
        $category->slug = $validated['slug'];
        $category->description = $request->description;
        $category->parent_id = $request->parent_id ?? null;
        $category->status = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $featuredImage = $request->file('image');
            $featuredImageName = $request->slug . '_' . time() . '.' . $featuredImage->getClientOriginalExtension();
            $featuredImagePath = public_path('categories/image/');
            $featuredImage->move($featuredImagePath, $featuredImageName);

            $category->image = 'categories/image/' . $featuredImageName;
        }

        $category->save();

        return redirect()->route('admin.categories.list')->with('success', 'Request has been completed');
    }


    public function status($id, Request $request)
    {
        Category::where('id', $id)->update(['status' => $request->status]);
        return response()->json(['message' => 'Request has been completed', 'status' => 200]);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Request has been completed');
    }

    private function generateUniqueCategoryId($length = 8)
    {
        do {
            $id = Str::random($length);
        } while (Category::where('unique_id', $id)->exists());

        return $id;
    }
}
