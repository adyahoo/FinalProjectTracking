<?php

namespace App\Http\Controllers\ProjectManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $projects      = Project::latest()->get()->take(3);
        $totalProjects = Project::count();

        return view('project.project_manager.pages.dashboard.dashboard', compact('projects', 'totalProjects'));
    }
}
