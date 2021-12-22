<?php

namespace App\Http\Controllers\ProjectManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Blog;

class DashboardController extends Controller
{
    public function index()
    {
        $projects         = Project::whereMyProject()->latest()->get();
        $launchedProjects = Project::whereMyProject()->whereLaunched()->count();
        $totalBlogs       = Blog::myBlogs()->count();

        return view('project.project_manager.pages.dashboard.dashboard', compact(
            'projects',
            'totalBlogs',
            'launchedProjects'
        ));
    }
}
