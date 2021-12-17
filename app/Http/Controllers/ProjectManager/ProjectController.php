<?php

namespace App\Http\Controllers\ProjectManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\LaunchDateRequest;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use App\Models\ProjectVersion;
use App\Models\ProjectDetail;
use Auth;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::where('user_id', Auth::user()->id)->get();
        $roles    = Role::get();
        $users    = User::get();

        return view('project.project_manager.pages.project.index', compact('projects', 'roles', 'users', 'request'));
    }

    public function create()
    {
        return view('project.project_manager.pages.project.create');
    }

    public function store(ProjectRequest $request)
    {
        $project = $request->all();
        $project += ['user_id' => Auth::user()->id];

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

    public function detail(Project $project)
    {
        $latestVersion      = ProjectVersion::where('project_id', $project->id)->latest()->first();
        $modulesDoneCount   = ProjectDetail::whereDone()->count();

        if($latestVersion->projectDetails->count() == 0) {
            $progressPercentage = 0;
        } else {
            $progressPercentage = ($modulesDoneCount / $latestVersion->projectDetails->count()) * 100;
        }

        return view('project.project_manager.pages.project.detail', compact(
            'project',
            'latestVersion',
            'modulesDoneCount',
            'progressPercentage'
        ));
    }

    public function scope(Project $project)
    {
        $title = 'Scope';
        $text  = $project->scope;

        return view('project.project_manager.pages.project.text_detail', compact('project', 'title', 'text'));
    }

    public function credentials(Project $project)
    {
        $title = 'Credentials';
        $text  = $project->credentials;

        return view('project.project_manager.pages.project.text_detail', compact('project', 'title', 'text'));
    }

    public function addLaunchDate(LaunchDateRequest $request, Project $project)
    {
        $project->update($request->all());

        return redirect()->back()->with('success', 'Project updated successfully');
    }
}