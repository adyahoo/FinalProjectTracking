<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class HomeBlogController extends Controller
{
    public function index() 
    {
        $newest     = Blog::with('user')->orderBy('published_at', 'DESC')->take(3)->get();
        $mostViewed = Blog::with('user')->orderBy('view_count', 'DESC')->take(4)->get();
        return view('blog.dashboard', compact('newest', 'mostViewed',));
    }
}
