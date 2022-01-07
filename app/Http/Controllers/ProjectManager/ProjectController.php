<?php

namespace App\Http\Controllers\ProjectManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\LaunchDateRequest;
use Spatie\Activitylog\Models\Activity;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use App\Models\ProjectVersion;
use App\Models\ProjectDetail;
use App\Traits\ProjectVersionTrait;
use App\Traits\DateTrait;
use DateTime;
use Auth;

class ProjectController extends Controller
{
    use ProjectVersionTrait, DateTrait;

    public function index(Request $request)
    {
        $startDate = "";
        $endDate   = "";

        if(!empty($request->start_end_date)) {
            $dates     = explode(' - ', $request->start_end_date);
            $startDate = $dates[0];
            $endDate   = $dates[1];
        }

        $projects        = Project::whereStartDate($startDate)
                                    ->whereEndDate($endDate)
                                    ->whereUserAssignee($request->user)
                                    ->whereRoleAssignee($request->role)
                                    ->whereProjectManager($request->project_manager)
                                    ->get();
        $roles           = Role::whereEmployee()->get();
        $projectManagers = Role::whereProjectManager()->first()->user;
        $employees       = Role::whereEmployee()->first()->user;

        return view('project.project_manager.pages.project.index', compact(
            'projects',
            'roles',
            'request',
            'projectManagers',
            'employees'
        ));
    }

    public function create()
    {
        return view('project.project_manager.pages.project.create');
    }

    public function store(ProjectRequest $request)
    {
        $project = $request->all();
        $project += ['user_id' => Auth::user()->id];
        $project += ['total_estimated_days' => $this->findInterval($request->start_date, $request->end_date)->format('%a')];

        $projectInserted = Project::create($project);

        $project_version                 = new ProjectVersion;
        $project_version->version_number = '1.0.0';
        $project_version->note           = 'First version';
        $project_version->description    = 'First version';

        $projectInserted->projectVersions()->save($project_version);

        return redirect()->route('project_manager.projects.all')->with('success', 'Project created successfully');
    }

    public function edit(Project $project)
    {
        return view('project.project_manager.pages.project.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->all());

        return redirect()->route('project_manager.projects.all')->with('success', 'Project updated successfully');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->back()->with('success', 'Project deleted successfully');
    }

    public function detail(Project $project, Request $request)
    {
        $versions        = ProjectVersion::where('project_id', $project->id)->latest()->get();
        $projectDetail   = new ProjectDetail();
        $logs            = Activity::where('subject_type', get_class($projectDetail))->latest()->get();
        $selectedVersion = $this->selectedVersion($versions, $request->version);

        if($selectedVersion->projectDetails->count() == 0) {
            $progressPercentage = 0;
        } else {
            $progressPercentage = ($selectedVersion->projectDetails()->whereDone()->count() / $selectedVersion->projectDetails->count()) * 100;
        }

        return view('project.project_manager.pages.project.detail', compact(
            'project',
            'versions',
            'progressPercentage',
            'logs',
            'selectedVersion'
        ));
    }

    public function scope(Project $project)
    {
        $title         = 'Scope';
        $text          = $project->scope;
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();

        return view('project.project_manager.pages.project.text_detail', compact('project', 'title', 'text', 'latestVersion'));
    }

    public function credentials(Project $project)
    {
        $title         = 'Credentials';
        $text          = $project->credentials;
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();

        return view('project.project_manager.pages.project.text_detail', compact('project', 'title', 'text', 'latestVersion'));
    }

    public function addLaunchDate(LaunchDateRequest $request, Project $project)
    {
        $project->update($request->all());

        return redirect()->back()->with('success', 'Project updated successfully');
    }
}