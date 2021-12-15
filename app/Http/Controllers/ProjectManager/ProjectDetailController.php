<?php

namespace App\Http\Controllers\ProjectManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectVersion;
use App\Models\ProjectDetail;
use App\Models\Module;

class ProjectDetailController extends Controller
{
    public function modules(Project $project)
    {
        $modules       = Module::get();
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();
        return view('project.project_manager.pages.project.module.list', compact('project', 'latestVersion', 'modules'));
    }

    public function create(Request $request, Project $project)
    {
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();
        $status        = 'not yet';

        $projectDetail = $request->all();
        $projectDetail += [
            'project_version_id' => $latestVersion->id,
            'status' => $status,
        ];

        ProjectDetail::create($projectDetail);

        return redirect()->back()->with('success', 'Module created successfully');
    }
}
