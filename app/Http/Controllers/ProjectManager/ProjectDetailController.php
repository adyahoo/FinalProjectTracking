<?php

namespace App\Http\Controllers\ProjectManager;

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
use App\Http\Requests\ProjectDetailSpecialRequest;
use App\Traits\ProjectVersionTrait;
use App\Traits\DateTrait;
use DateTime;
use Carbon\Carbon;

class ProjectDetailController extends Controller
{
    use ProjectVersionTrait, DateTrait;

    public function index(Project $project, Request $request)
    {
        $modules         = Module::get();
        $employees       = Role::whereEmployee()->first()->user;
        $versions        = ProjectVersion::where('project_id', $project->id)->latest()->get();
        $selectedVersion = $this->selectedVersion($versions, $request->version, $project);
        $statusOptions   = (new ProjectDetail())->statusOption;

        return view('project.project_manager.pages.project.module.index', compact(
            'project',
            'selectedVersion',
            'modules',
            'employees',
            'versions',
            'statusOptions',
            'request'
        ));
    }

    public function store(ProjectDetailRequest $request, Project $project)
    {
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();

        $projectDetail                     = new ProjectDetail();
        $projectDetail->project_version_id = $latestVersion->id;
        $projectDetail->status             = $projectDetail->statusOption['open'];
        $dates                             = explode(' - ', $request->start_end_date);
        $projectDetail->start_date         = $dates[0];
        $projectDetail->end_date           = $dates[1];

        $module = Module::find($request->moduleable_id);

        $module->project_detail()->save($projectDetail);

        return redirect()->back()->with('success', 'Module created successfully');
    }

    public function storeSpecial(ProjectDetailSpecialRequest $request, Project $project)
    {
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();

        $startDate = new DateTime($request->start_date);
        $endDate   = new DateTime($request->end_date);

        $specialModule = $request->all();
        $specialModule += ['time_estimation' => $startDate->diff($endDate)->d];

        $specialModuleInserted = SpecialModule::create($specialModule);

        $projectDetail                     = new ProjectDetail();
        $projectDetail->project_version_id = $latestVersion->id;
        $projectDetail->status             = $projectDetail->statusOption['open'];
        $dates                             = explode(' - ', $request->start_end_date);
        $projectDetail->start_date         = $dates[0];
        $projectDetail->end_date           = $dates[1];

        $specialModuleInserted->project_detail()->save($projectDetail);

        return redirect()->back()->with('success', 'Module created successfully');
    }

    public function show(ProjectDetail $projectDetail, Request $request)
    {
        $startInterval = '';
        $endInterval   = '';

        $employees = Role::whereEmployee()->first()->user;

        if(!empty($projectDetail->start_date_actual)) {
            $startInterval = $projectDetail->start_date->diff($projectDetail->start_date_actual);
            $endInterval   = $projectDetail->end_date->diff($projectDetail->end_date_actual);
        }

        return view('project.project_manager.pages.project.module.detail', compact('projectDetail', 'employees', 'startInterval', 'endInterval', 'request'));
    }

    public function edit(ProjectDetail $projectDetail)
    {
        $projectDetail->setAttribute('moduleable', $projectDetail->moduleable);
        $projectDetail->setAttribute('start_dates', $projectDetail->start_date->format('Y-m-d'));
        $projectDetail->setAttribute('start_times', Carbon::parse($projectDetail->start_date)->format('H:i:s'));
        $projectDetail->setAttribute('end_dates', $projectDetail->end_date->format('Y-m-d'));
        $projectDetail->setAttribute('end_times', Carbon::parse($projectDetail->end_date)->format('H:i:s'));
        $projectDetail->setAttribute('start_date_actuals', $projectDetail->start_date_actual->format('Y-m-d'));
        $projectDetail->setAttribute('start_time_actuals', Carbon::parse($projectDetail->start_date_actual)->format('H:i:s'));
        $projectDetail->setAttribute('end_date_actuals', $projectDetail->end_date_actual->format('Y-m-d'));
        $projectDetail->setAttribute('end_time_actuals', Carbon::parse($projectDetail->end_date_actual)->format('H:i:s'));

        return response()->json($projectDetail);
    }

    public function update(ProjectDetailRequest $request, ProjectDetail $projectDetail)
    {
        $projectDetailUpdate = $request->all();

        if($request->start_end_date) {
            $dates               = explode(' - ', $request->start_end_date);
            $projectDetailUpdate += ['start_date' => $dates[0]];
            $projectDetailUpdate += ['end_date'   => $dates[1]];
        }

        if(!empty($request->start_end_date_actual)) {
            $dates               = explode(' - ', $request->start_end_date_actual);
            $projectDetailUpdate += ['start_date_actual' => $dates[0]];
            $projectDetailUpdate += ['end_date_actual'   => $dates[1]];
        }

        $projectDetail->update($projectDetailUpdate);

        return redirect()->back()->with('success', 'Project module updated successfully');
    }

    public function updateSpecial(ProjectDetailSpecialRequest $request, ProjectDetail $projectDetail)
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
