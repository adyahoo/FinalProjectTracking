<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Blog;
use Spatie\Activitylog\Models\Activity;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index() {
        $temp             = array();
        $latestProjects   = Project::latest()->get()->take(5);
        $totalProjects    = Project::count();
        $totalBlogs       = Blog::get()->count();
        $logs             = Activity::latest()->get()->take(4);
        // return $logs;
        $launchedProjects = Project::whereLaunched()->count();
        $projects         = Project::all();
        foreach($projects as $project) {
            array_push($temp, [
                'title'           => 'Project: '.$project->name,
                'description'     => 'Description: '.$project->description,
                'url'             => route('admin.admin_projects.detail', $project->id),
                'start'           => Carbon::parse($project->start_date)->format('Y-m-d'),
                'end'             => Carbon::parse($project->end_date)->format('Y-m-d'),
                'backgroundColor' => "#".substr(md5(rand()), 0, 6),
                'borderColor'     => "#fff",
                'textColor'       => '#fff',
            ]);
        }
        
        $data = json_encode($temp);
        return view('project.admin.pages.dashboard.dashboard', compact(
            'launchedProjects',
            'totalProjects',
            'latestProjects',
            'totalBlogs',
            'logs',
            'data'
        ));
    }
}
