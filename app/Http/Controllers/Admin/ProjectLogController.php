<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Models\Project;
use App\Models\ProjectDetail;
use App\Models\ProjectVersion;
use App\Traits\ProjectVersionTrait;

class ProjectLogController extends Controller
{
    use ProjectVersionTrait;
    
    public function index(Project $project, Request $request) {
        $logs            = Activity::where('log_name', 'project')
                                    ->where('properties->project_id', $project->id)
                                    ->latest()
                                    ->get();
        $versions        = ProjectVersion::where('project_id', $project->id)->latest()->get();
        $selectedVersion = $this->selectedVersion($versions, $request->version, $project);

        return view('project.admin.pages.projects.log.index', compact('project', 'logs', 'versions', 'selectedVersion', 'request'));
    }
}
