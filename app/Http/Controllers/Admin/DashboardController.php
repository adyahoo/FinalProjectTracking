<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Blog;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index() {
        $latestProjects = Project::latest()->get()->take(5);
        $totalProjects  = Project::count();
        $projects       = Project::get();
        $totalBlogs     = Blog::get()->count();
        $blogs          = Blog::latest()->get()->take(7);
        $logs           = Activity::latest()->get()->take(4);

        $finishedProjects = 0;

        foreach($projects as $project)
            $finishedProjects += $project->projectDetails->where('status', 'done')->count();

        return view('project.admin.pages.dashboard.dashboard', compact(
            'finishedProjects',
            'totalProjects',
            'latestProjects',
            'totalBlogs',
            'logs',
            'blogs'
        ));
    }
}
