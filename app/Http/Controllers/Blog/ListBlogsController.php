<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListBlogsController extends Controller
{    
    public function returnSearch(Request $request)
    {
        return view('blog.blog_search', compact('request'));
    }
}
