<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class DetailBlogController extends Controller
{
    public function index($slug)
    {
        $blog = Blog::with('user')->where('slug', $slug)->first();
        $blog->view_count += 1;
        $blog->update();
        $relatedBlogs = Blog::with('user')->where('blog_category_id', $blog->blog_category_id)->take(4)->get();
        return view('blog.detail_blog', compact('blog', 'relatedBlogs'));
    }
}
