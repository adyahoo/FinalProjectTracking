<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectVersion;
use App\Models\ProjectDetail;
use App\Models\Module;
use App\Models\Role;
use App\Models\SpecialModule;
use App\Http\Requests\ModuleRequest;
use App\Http\Requests\ProjectDetailRequest;
use DateTime;

class ProjectDetailController extends Controller
{
    public function index(Project $project, Request $request) {
        $modules        = Module::get();
        $employees      = Role::whereEmployee()->first()->user;
        $latestVersion  = ProjectVersion::where('project_id', $project->id)->latest()->first();
        $versions       = ProjectVersion::where('project_id', $project->id)->get();
        $projectModules = $project->projectDetails;
        $statusOptions  = (new ProjectDetail())->statusOption;

        if(!empty($request->version))
            $projectModules = ProjectDetail::where('project_version_id', $request->version)->get();

        return view('project.admin.pages.projects.module.index', compact(
            'project',
            'projectModules',
            'latestVersion',
            'modules',
            'employees',
            'versions',
            'request',
            'statusOptions'
        ));
    }

    public function store(ProjectDetailRequest $request, Project $project) {
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();

        $projectDetail                     = new ProjectDetail();
        $projectDetail->project_version_id = $latestVersion->id;
        $projectDetail->status             = $projectDetail->statusOption['not_yet'];
        $projectDetail->start_date         = $request->start_date;
        $projectDetail->end_date           = $request->end_date;

        $module = Module::find($request->moduleable_id);

        $module->project_detail()->save($projectDetail);

        return redirect()->back()->with('success', 'Module created successfully');
    }

    public function storeSpecial(ProjectDetailRequest $request, Project $project) {
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();

        $startDate = new DateTime($request->start_date);
        $endDate   = new DateTime($request->end_date);

        $specialModule = $request->all();
        $specialModule += ['time_estimation' => $startDate->diff($endDate)->d];

        $specialModuleInserted = SpecialModule::create($specialModule);

        $projectDetail                     = new ProjectDetail();
        $projectDetail->project_version_id = $latestVersion->id;
        $projectDetail->status             = $projectDetail->statusOption['not_yet'];
        $projectDetail->start_date         = $request->start_date;
        $projectDetail->end_date           = $request->end_date;

        $specialModuleInserted->project_detail()->save($projectDetail);

        return redirect()->back()->with('success', 'Module created successfully');
    }

    public function show(ProjectDetail $projectDetail) {
        $employees = Role::whereEmployee()->first()->user;

        return view('project.admin.pages.projects.module.detail', compact('projectDetail', 'employees'));
    }

    public function edit(ProjectDetail $projectDetail) {
        $projectDetail->setAttribute('moduleable', $projectDetail->moduleable);

        return response()->json($projectDetail);
    }

    public function update(ProjectDetailRequest $request, ProjectDetail $projectDetail) {
        $projectDetail->update($request->all());

        return redirect()->back()->with('success', 'Project module updated successfully');
    }

    public function updateSpecial(ProjectDetailRequest $request, ProjectDetail $projectDetail) {
        $projectDetail->update($request->all());

        $startDate = new DateTime($request->start_date);
        $endDate   = new DateTime($request->end_date);

        $specialModule = $request->all();
        $specialModule += ['time_estimation' => $startDate->diff($endDate)->d];

        $projectDetail->moduleable->update($specialModule);

        return redirect()->back()->with('success', 'Project special module updated successfully');
    }

    public function destroy(ProjectDetail $projectDetail) {
        $projectDetail->delete();

        return redirect()->back()->with('success', 'Project module deleted successfully');
    }

    public function destroySpecial(ProjectDetail $projectDetail) {
        $projectDetail->delete();

        $projectDetail->moduleable->delete();

        return redirect()->back()->with('success', 'Project special module deleted successfully');
    }
}
