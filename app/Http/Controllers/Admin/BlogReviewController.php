<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogReview;
use App\Http\Requests\BlogReviewRequest;
use Carbon\Carbon;

class BlogReviewController extends Controller
{
    public function index()
    {
        $reviewBlogs = Blog::getReviews()->get();
        $blogs       = Blog::getWaitingForReview()->get();
        return view('project.admin.pages.blogs.blog_review.index', compact('blogs', 'reviewBlogs'));
    }

    public function store(BlogReviewRequest $request, Blog $blog)
    {
        $blogReview  = $request->all();
        $blog_review = new BlogReview($blogReview);
        
        $blog_review->save();

        if($request->status == 'Published') {
            $blogReview += ['published_at' => Carbon::now()];
        }

        $blog->update($blogReview);
        return redirect()->route('admin.review.index')->with('success', 'Blog Review created successfully');
    }

    public function show($review)
    {
        $reviews = BlogReview::with('blog')->where('blog_id', $review)->orderBy('created_at', 'desc')->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('F Y');
        });
        return view('project.admin.pages.blogs.blog_review.detail', compact('reviews'));
    }
}
