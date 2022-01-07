<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogLike;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeBlogController extends Controller
{
    public function index() 
    {
        $newest     = Blog::with('user')->orderBy('published_at', 'DESC')->take(3)->get();
        $mostViewed = Blog::with('user')->orderBy('view_count', 'DESC')->take(4)->get();
        $mostLiked = Blog::with('user')->withCount('likers')->orderBy('likers_count', 'DESC')->take(4)->get();
        return view('blog.dashboard', compact('newest', 'mostViewed', 'mostLiked'));
    }

    public function likePost(Request $request){
        $blog     = Blog::find($request->id);
        $response = auth()->user()->toggleLike($blog);

        return response()->json(['success'=>$response]);
    }
}
