<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectVersion;
use App\Models\ProjectDetail;
use App\Models\Module;
use App\Models\Role;
use App\Models\SpecialModule;
use App\Http\Requests\ModuleRequest;
use App\Traits\ProjectVersionTrait;
use DateTime;

class ProjectDetailController extends Controller
{
    use ProjectVersionTrait;

    public function index(Project $project, Request $request)
    {
        $modules         = Module::get();
        $employees       = Role::whereEmployee()->first()->user;
        $versions        = ProjectVersion::where('project_id', $project->id)->latest()->get();
        $selectedVersion = $this->selectedVersion($versions, $request->version, $project);
        $statusOptions   = (new ProjectDetail())->statusOption;

        return view('project.employee.pages.project.module.index', compact(
            'project',
            'selectedVersion',
            'modules',
            'employees',
            'versions',
            'request',
            'statusOptions'
        ));
    }

    public function store(Request $request, Project $project)
    {
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

    public function storeSpecial(Request $request, Project $project)
    {
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

    public function show(ProjectDetail $projectDetail, Request $request)
    {
        $startInterval = '';
        $endInterval   = '';

        if(!empty($projectDetail->start_date_actual)) {
            $startInterval = $projectDetail->start_date->diff($projectDetail->start_date_actual);
            $endInterval   = $projectDetail->end_date->diff($projectDetail->end_date_actual);
        }

        return view('project.employee.pages.project.module.detail', compact('projectDetail', 'startInterval', 'endInterval', 'request'));
    }

    public function edit(ProjectDetail $projectDetail)
    {
        $projectDetail->setAttribute('moduleable', $projectDetail->moduleable);

        return response()->json($projectDetail);
    }

    public function update(Request $request, ProjectDetail $projectDetail)
    {
        $projectDetail->update($request->all());

        return redirect()->back()->with('success', 'Project module updated successfully');
    }

    public function updateSpecial(Request $request, ProjectDetail $projectDetail)
    {
        $projectDetail->update($request->all());

        $startDate = new DateTime($request->start_date);
        $endDate   = new DateTime($request->end_date);

        $specialModule = $request->all();
        $specialModule += ['time_estimation' => $startDate->diff($endDate)->d];

        $projectDetail->moduleable->update($specialModule);

        return redirect()->back()->with('success', 'Project special module updated successfully');
    }

    public function destroy(ProjectDetail $projectDetail)
    {
        $projectDetail->delete();

        return redirect()->back()->with('success', 'Project module deleted successfully');
    }

    public function destroySpecial(ProjectDetail $projectDetail)
    {
        $projectDetail->delete();

        $projectDetail->moduleable->delete();

        return redirect()->back()->with('success', 'Project special module deleted successfully');
    }
}
