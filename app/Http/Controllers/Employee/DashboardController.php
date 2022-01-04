<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Blog;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $projects         = Project::whereUserAssignee(array(Auth::user()->id))->latest()->get();
        $launchedProjects = Project::whereUserAssignee(array(Auth::user()->id))->whereLaunched()->count();
        $totalBlogs       = Blog::myBlogs()->count();

        return view('project.employee.pages.dashboard.dashboard', compact(
            'projects',
            'totalBlogs',
            'launchedProjects'
        ));
    }
}
