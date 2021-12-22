<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategories;
use App\Models\User;

class ListBlogsController extends Controller
{
    public function index()
    {
        $blogs       = Blog::with('user')->get();
        $bannerBlogs = Blog::with('user')->orderBy('published_at', 'DESC')->take(3)->get();
        return view('blog.blog_list', compact('blogs', 'bannerBlogs'));
    }

    public function sort(Request $request)
    {
        if ($request->ajax()) {
            $data   = $request->all();
            $blogs  = Blog::with('user');
            $result = $data['sort'] == "Oldest" ? $blogs->orderBy('published_at', "ASC")->get() : $blogs->orderBy('published_at', "DESC")->get();
            // $view   = view('components.content-horiz', compact('result'))->render();
            
            return json_encode([
                // 'view' => $view,
                'data' => $result,
            ]);
        }
    }

    public function returnSearch(Request $request)
    {
        $user  = User::where('name','LIKE','%'.$request->searchInput.'%')->first();
        $blogs = is_null($user) ? null : Blog::with('user')->where('user_id', $user->id)->get();
        return view('blog.blog_search', compact('request', 'blogs'));
    }

    public function returnSidebar(Request $request)
    {
        $blogs = Blog::with('user');

        if(!empty($request->filterSidebar['category'])) {
            $category = BlogCategories::where('name', $request->filterSidebar['category'])->first();
            $blogs      = $blogs->where('blog_category_id', $category->id);
        }
        if(!empty($request->filterSidebar['year'])) {
            $blogs = $blogs->whereYear('published_at', $request->filterSidebar['year']);
        }
        if(!empty($request->filterSidebar['month'])) {
            $blogs = $blogs->whereMonth('published_at', $request->filterSidebar['month']);
        }

        $blogs = $blogs->get();

        return view('blog.blog_search', compact('request', 'blogs'));
    }

    public function returnKategori(Request $request)
    {
        $blogs = Blog::with('user', 'blogCategory')->where('blog_category_id', $request->categoryId)->get();
        return view('blog.blog_search', compact('request', 'blogs'));
    }
}