<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Models\Project;

class ProjectLogController extends Controller
{
    public function index(Project $project)
    {
        $logs = Activity::where('subject_type', 'App\Models\ProjectDetail')->get();

        return view('project.admin.pages.projects.log.index', compact('project', 'logs'));
    }
}
