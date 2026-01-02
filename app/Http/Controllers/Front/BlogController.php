<?php

namespace App\Http\Controllers\Front;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function list()
    {
        $blogs = Blog::where('status', 'active')->latest()->paginate(10);
        return view('front.blogs.list', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::where('status', 'active')->where('id', $id)->first();
        return view('front.blogs.show', compact('blog'));
    }
}
