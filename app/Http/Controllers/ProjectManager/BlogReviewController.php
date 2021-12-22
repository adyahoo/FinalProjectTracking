<?php

namespace App\Http\Controllers\ProjectManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogReview;

class BlogReviewController extends Controller
{
    public function show(Blog $blog)
    {
        $blogReviews = BlogReview::where('blog_id', $blog->id)->get();

        return view('project.project_manager.pages.blog.review', compact('blogReviews', 'blog'));
    }
}
