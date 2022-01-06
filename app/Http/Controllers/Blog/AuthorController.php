<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Blog;

class AuthorController extends Controller
{
    public function index($name)
    {
        $user  = User::where('name', $name)->first();
        $blogs = Blog::with('user')->where('user_id', $user->id)->get();
        return view('blog.author', compact('user', 'blogs'));
    }

    public function sort(Request $request)
    {
        if ($request->ajax()) {
            $data      = $request->all();
            $blogs     = Blog::with('user')->where('user_id', $data['id']);
            $results   = $data['data'] == "oldest" ? $blogs->orderBy('published_at', "ASC")->get() : $blogs->orderBy('published_at', "DESC")->get();
    
            $component = $data['type'] == "grid" ? View::make("components.content-vert") : View::make("components.content-horiz");
            $view      = $component->with('blogs', $results)->render();
            
            if (count($results) > 0) {
                echo $view;
            } else {
                echo '<div class="col">No Data</div>';
            }
        }
    }
}