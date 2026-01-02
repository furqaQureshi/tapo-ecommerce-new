<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('blogs/summernote', 'public');
            return response()->json(['url' => asset('storage/' . $path)]);
        }
        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function index()
    {
        return view('admin.blogs.index');
    }

    public function getBlogs(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::with('category')->select(['id', 'title', 'category_id', 'status']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category', function ($row) {
                    return $row->category->name;
                })
                ->addColumn('status', function ($row) {
                    $checked = $row->status == 'active' ? 'checked' : '';
                    return '<input type="checkbox" class="status" data-id="' . $row->id . '" ' . $checked . '>';
                })
                ->addColumn('actions', function ($row) {
                    return '
                        <a href="' . route('admin.blog.edit', $row->id) . '" class="action_btn edit-item"><i class="ri-edit-line"></i></a>
                        <button class="action_btn delete-item" data-id="' . $row->id . '" ><i class="bx bx-trash"></i></button>

                    ';
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }
    }

    public function create()
    {
        $categories = BlogCategory::where('status', 1)->get();
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'quote' => 'nullable|string',
            'summary' => 'nullable|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id',
            'tags' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'title',
            'quote',
            'summary',
            'description',
            'category_id',
            'tags',
            'status'
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('public/blogs', $imageName);
            $data['image'] = 'blogs/' . $imageName;
        }

        Blog::create($data);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::where('status', 1)->get();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'quote' => 'nullable|string',
            'summary' => 'nullable|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id',
            'tags' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $blog = Blog::findOrFail($id);
        $data = $request->only([
            'title',
            'quote',
            'summary',
            'description',
            'category_id',
            'tags',
            'status'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($blog->image && Storage::exists('public/' . $blog->image)) {
                Storage::delete('public/' . $blog->image);
            }
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('public/blogs', $imageName);
            $data['image'] = 'blogs/' . $imageName;
        }

        $blog->update($data);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully');
    }



    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();
        return response()->json(['success' => 'Blog deleted successfully']);
    }

    public function updateStatus(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->status = $request->status ? 'active' : 'inactive';
        $blog->save();
        return response()->json(['success' => 'Status updated successfully']);
    }
}
