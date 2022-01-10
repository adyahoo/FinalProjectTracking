<?php

namespace App\Http\Controllers\Admin;

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

    public function index(Request $request) {
        $startDate = "";
        $endDate   = "";

        if(!empty($request->start_end_date)) {
            $dates     = explode(' - ', $request->start_end_date);
            $startDate = $dates[0];
            $endDate   = $dates[1];
        }

        $projects        = Project::whereStartDate($request->start_date)
                                ->whereEndDate($request->end_date)
                                ->whereUserAssignee($request->user)
                                ->whereRoleAssignee($request->role)
                                ->get();
        $projectManagers = User::whereProjectManager()->get();
        $employees       = User::whereEmployee()->get();
        $roles           = Role::whereEmployee()->get();

        return view('project.admin.pages.projects.index', compact(
            'projects', 
            'roles', 
            'request', 
            'projectManagers', 
            'employees'
        ));
    }

    public function create() {
        return view('project.admin.pages.projects.create');
    }

    public function store(ProjectRequest $request) {
        $dates   = explode(' - ', $request->start_end_date);
        $project = $request->all();
        $project += ['user_id' => Auth::user()->id];
        $project += ['start_date' => $dates[0]];
        $project += ['end_date' => $dates[1]];
        $project += ['total_estimated_days' => $this->findInterval($dates[0], $dates[1])->format('%a')];

        $projectInserted = Project::create($project);

        $project_version                 = new ProjectVersion;
        $project_version->version_number = '1.0.0';
        $project_version->note           = 'First version';
        $project_version->description    = 'First version';

        $projectInserted->projectVersions()->save($project_version);

        return redirect()->route('admin.admin_projects.index')->with('success', 'Project created successfully');
    }

    public function edit(Project $project) {
        return view('project.admin.pages.projects.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project) {
        $projectUpdate = $request->all();

        $dates         = explode(' - ', $request->start_end_date);
        $projectUpdate += ['start_date' => $dates[0]];
        $projectUpdate += ['end_date'   => $dates[1]];
        $projectUpdate += ['total_estimated_days' => $this->findInterval($dates[0], $dates[1])->format('%a')];

        $project->update($projectUpdate);

        return redirect()->route('admin.admin_projects.index')->with('success', 'Project updated successfully');
    }

    public function destroy(Project $project) {
        $project->delete();

        return redirect()->back()->with('success', 'Project deleted successfully');
    }

    public function detail(Project $project, Request $request) {
        $versions        = ProjectVersion::where('project_id', $project->id)->latest()->get();
        $logs            = Activity::where('log_name', 'project')
                                    ->where('properties->project_id', $project->id)
                                    ->latest()
                                    ->take(4)
                                    ->get();
        $selectedVersion = $this->selectedVersion($versions, $request->version, $project);

        if($selectedVersion->projectDetails->count() == 0) {
            $progressPercentage = 0;
        } else {
            $progressPercentage = ($selectedVersion->projectDetails()->whereDone()->count() / $selectedVersion->projectDetails->count()) * 100;
        }

        return view('project.admin.pages.projects.detail', compact(
            'project',
            'versions',
            'selectedVersion',
            'progressPercentage',
            'logs',
            'request'
        ));
    }

    public function scope(Project $project) {
        $title         = 'Scope';
        $text          = $project->scope;
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();

        return view('project.admin.pages.projects.text_detail', compact('project', 'title', 'text', 'latestVersion'));
    }

    public function credentials(Project $project) {
        $title         = 'Credentials';
        $text          = $project->credentials;
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();

        return view('project.admin.pages.projects.text_detail', compact('project', 'title', 'text', 'latestVersion'));
    }

    public function addLaunchDate(LaunchDateRequest $request, Project $project) {
        $project->update($request->all());

        return redirect()->back()->with('success', 'Project updated successfully');
    }
}