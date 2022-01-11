<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategories;
use App\Models\User;
use Illuminate\Support\Facades\View;

class ListBlogsController extends Controller
{
    public function index()
    {
        $blogs       = Blog::with('user')->whereNotNull('published_at')->get();
        $bannerBlogs = Blog::with('user')->whereNotNull('published_at')->orderBy('published_at', 'DESC')->take(3)->get();
        return view('blog.blog_list', compact('blogs', 'bannerBlogs'));
    }

    public function sort(Request $request)
    {
        if ($request->ajax()) {
            $data      = $request->all();
            $blogs     = Blog::with('user')->whereNotNull('published_at');
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

    public function returnSearch(Request $request)
    {
        $user  = User::where('name','LIKE','%'.$request->searchInput.'%')->first();
        $blogs = is_null($user) ? null : Blog::with('user')->whereNotNull('published_at')->where('user_id', $user->id)->get();
        return view('blog.blog_search', compact('request', 'blogs'));
    }

    public function returnSidebar(Request $request)
    {
        $blogs = Blog::with('user');

        if(!empty($request->filterSidebar['category'])) {
            $category = BlogCategories::where('name', $request->filterSidebar['category'])->first();
            $blogs    = $blogs->where('blog_category_id', $category->id);
        }
        if(!empty($request->filterSidebar['year'])) {
            $blogs = $blogs->whereYear('published_at', $request->filterSidebar['year']);
        }
        if(!empty($request->filterSidebar['month'])) {
            $month = date("m", strtotime($request->filterSidebar['month']));
            $blogs = $blogs->whereMonth('published_at', $month);
        }

        $blogs = $blogs->whereNotNull('published_at')->get();

        return view('blog.blog_search', compact('request', 'blogs'));
    }

    public function returnKategori(Request $request)
    {
        $blogs = Blog::with('user', 'blogCategory')->whereNotNull('published_at')->where('blog_category_id', $request->categoryId)->get();
        return view('blog.blog_search', compact('request', 'blogs'));
    }
}