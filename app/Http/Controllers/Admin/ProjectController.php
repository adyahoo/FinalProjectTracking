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
use Auth;

class ProjectController extends Controller
{
    public function index(Request $request) {
        $projects  = Project::whereStartDate($request->start_date)
                        ->whereEndDate($request->end_date)
                        ->whereUserAssignee($request->user)
                        ->whereRoleAssignee($request->role)
                        ->get();
        $roles     = Role::whereEmployee()->get();
        $employees = Role::whereEmployee()->first()->user;

        return view('project.admin.pages.projects.index', compact('projects', 'roles', 'employees', 'request'));
    }

    public function create() {
        return view('project.admin.pages.projects.create');
    }

    public function store(ProjectRequest $request) {
        $project = $request->all();
        $project += ['user_id' => Auth::user()->id];

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
        $project->update($request->all());

        return redirect()->route('admin.admin_projects.index')->with('success', 'Project updated successfully');
    }

    public function destroy(Project $project) {
        $project->delete();

        return redirect()->back()->with('success', 'Project deleted successfully');
    }

    public function detail(Project $project) {
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();
        $projectDetail = new ProjectDetail();
        $logs          = Activity::where('subject_type', get_class($projectDetail))->latest()->get();

        if($latestVersion->projectDetails->count() == 0) {
            $progressPercentage = 0;
        } else {
            $progressPercentage = ($latestVersion->projectDetails()->whereDone()->count() / $latestVersion->projectDetails->count()) * 100;
        }

        return view('project.admin.pages.projects.detail', compact(
            'project',
            'latestVersion',
            'progressPercentage',
            'logs'
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