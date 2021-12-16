<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BlogCategories;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::with('user', 'blogCategory')->get();
        return view('project.admin.pages.blogs.admin_blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BlogCategories::all();
        return view('project.admin.pages.blogs.admin_blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {   
        $blogs = $request->all();
        if ($request->meta_title == '') {
            $blogs['meta_title'] = $request->title;
        }
        
        if ($request->meta_description == '') {
            $blogs['meta_description'] = str_replace('<p>', '', substr($request->content, 0, 200));
        }
        
        if ($request->slug == '') {
            $blogs['slug'] = Str::slug($request->title);
        }

        $blogs += [
            'published_at' => Carbon::now(),
        ];

        $blog = new Blog($blogs);
        $blog->save();
        return redirect()->route('admin.blog.index')->with('success', 'Blog created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        return view('blog.detail_blog', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
