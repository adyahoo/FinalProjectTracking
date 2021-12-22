<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;

class AuthorController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        $blogs = Blog::with('user')->where('user_id', $id)->get();
        return view('blog.author', compact('user', 'blogs'));
    }
}