<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\UserAssignment;
use App\Models\Blog;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $latestProjects = UserAssignment::where('user_id', Auth::user()->id)->get()->projects;
        $totalProjects  = Project::count();
        $projects       = Project::get();
        $totalBlogs     = Blog::myBlogs()->count();

        $finishedProjects = 0;

        foreach($projects as $project)
            $finishedProjects += $project->projectDetails->where('status', 'done')->count();

        return view('project.employee.pages.dashboard.dashboard', compact(
            'finishedProjects',
            'totalProjects',
            'latestProjects',
            'totalBlogs'
        ));
    }
}
