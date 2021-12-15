<?php

namespace App\Http\Controllers\ProjectManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectVersion;
use App\Models\ProjectDetail;
use App\Models\Module;
use App\Models\SpecialModule;
use App\Http\Requests\ModuleRequest;

class ProjectDetailController extends Controller
{
    public function index(Project $project)
    {
        $modules       = Module::get();
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();

        return view('project.project_manager.pages.project.module.list', compact('project', 'latestVersion', 'modules'));
    }

    public function create(Request $request, Project $project)
    {
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();

        $projectDetail                     = new ProjectDetail();
        $projectDetail->project_version_id = $latestVersion->id;
        $projectDetail->status             = $projectDetail->statusOption['not_yet'];
        $projectDetail->start_date         = $request->start_date;
        $projectDetail->end_date           = $request->end_date;

        $module = Module::find($request->module_id);

        $module->project_detail()->save($projectDetail);

        return redirect()->back()->with('success', 'Module created successfully');
    }

    public function createSpecial(Request $request, Project $project)
    {
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();

        $specialModule = SpecialModule::create($request->all());

        $projectDetail                     = new ProjectDetail();
        $projectDetail->project_version_id = $latestVersion->id;
        $projectDetail->status             = $projectDetail->statusOption['not_yet'];
        $projectDetail->start_date         = $request->start_date;
        $projectDetail->end_date           = $request->end_date;

        $specialModule->project_detail()->save($projectDetail);

        return redirect()->back()->with('success', 'Module created successfully');
    }

    public function show(Module $module)
    {
        return response()->json($module);
    }
}
