<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogReview;
use App\Http\Requests\BlogReviewRequest;

class BlogReviewController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user', 'blogCategory')->orderBy('updated_at', 'desc')->get();
        return view('project.admin.pages.blogs.blog_review.index', compact('blogs'));
    }

    public function store(Request $request)
    {
        $blog_review = new BlogReview($request->all());
        $blog_review->save();
        return redirect()->route('admin.blog.review.index')->with('success', 'Blog Review created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
