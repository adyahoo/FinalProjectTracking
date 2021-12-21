<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategories;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Str;
use Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user', 'blogCategory')
                    ->orderBy('created_at', 'desc')
                    ->myBlogs()
                    ->get();

        return view('project.employee.pages.blog.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategories::all();
        $statusOption = (new Blog)->statusOption;

        return view('project.employee.pages.blog.create', compact('categories', 'statusOption'));
    }

    public function store(BlogRequest $request)
    {
        $blogs = $request->all();
        $blogs += ['user_id' => Auth::user()->id];

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

        Blog::create($blogs);

        return redirect()->route('employee.blogs.all')->with('success', 'Blog created successfully');
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->first();

        return view('blog.blog_preview', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategories::all();

        return view('project.employee.pages.blog.edit', compact('blog', 'categories'));
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        $newBlog = $request->all();
        $newBlog += ['user_id' => Auth::user()->id];

        $blog->update($newBlog);

        return redirect()->route('employee.blogs.all')->with('success', 'Blog updated successfully');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('employee.blogs.all')->with('success', 'Blog deleted successfully');
    }
}
