<?php

namespace App\Http\Controllers\ProjectManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $latestProjects = Project::latest()->get()->take(3);
        $totalProjects  = Project::count();
        $projects       = Project::get();

        $finishedProjects = 0;
        foreach($projects as $project) {
            $finishedProjects += $project->projectDetails->where('status', 'done')->count();
        }

        return view('project.project_manager.pages.dashboard.dashboard', compact('finishedProjects', 'totalProjects', 'latestProjects'));
    }
}
