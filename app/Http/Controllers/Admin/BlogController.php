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
    public function index()
    {
        $blogs = Blog::with('user', 'blogCategory')->orderBy('created_at', 'desc')->get();
        return view('project.admin.pages.blogs.admin_blog.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategories::all();
        return view('project.admin.pages.blogs.admin_blog.create', compact('categories'));
    }

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

        if ($request->status == 'Published') {
            $blogs += [
                'published_at' => Carbon::now(),
            ];
        }

        $blog = new Blog($blogs);
        $blog->save();
        return redirect()->route('admin.blog.index')->with('success', 'Blog created successfully');
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        return view('blog.blog_preview', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategories::all();
        return view('project.admin.pages.blogs.admin_blog.edit', compact('blog', 'categories'));
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        $blogs = $request->all();
        if ($request->status == 'Published') {
            $blogs += [
                'published_at' => Carbon::now(),
            ];
        }
        $blog->update($blogs);
        return redirect()->route('admin.blog.index')->with('success', 'Blog updated successfully');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Blog deleted successfully');
    }
}
