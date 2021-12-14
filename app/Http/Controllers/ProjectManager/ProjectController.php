<?php

namespace App\Http\Controllers\ProjectManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use App\Models\ProjectVersion;
use Auth;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::get();
        $roles    = Role::get();
        $users    = User::get();

        return view('project.project_manager.pages.project.list', compact('projects', 'roles', 'users', 'request'));
    }

    public function create()
    {
        return view('project.project_manager.pages.project.create');
    }

    public function store(ProjectRequest $request)
    {
        if($request->validator->fails())
            return redirect()->route('project_manager.projects.create')
                             ->withErrors($request->validator->messages());

        $project = $request->all();
        $project += ['user_id' => Auth::user()->id];

        $projectInserted = Project::create($project);

        $project_version                 = new ProjectVersion;
        $project_version->version_number = '1.0.0';
        $project_version->note           = 'First version';
        $project_version->description    = 'First version';

        $projectInserted->project_versions()->save($project_version);

        return redirect()->route('project_manager.projects.all')->with('success', 'Project created successfully');
    }

    public function edit(Project $project)
    {
        return view('project.project_manager.pages.project.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        if($request->validator->fails())
            return redirect()->route('project_manager.projects.edit', $project)
                             ->withErrors($request->validator->messages());

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
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();
        return view('project.project_manager.pages.project.detail', compact('project', 'latestVersion'));
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

    public function modules(Project $project)
    {
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();
        return view('project.project_manager.pages.project.modules', compact('project', 'latestVersion'));
    }
}