<?php

namespace App\Http\Controllers\ProjectManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::get();

        return view('project.project_manager.pages.project.list', compact('projects'));
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

        $message = $request->all();
        $message += ['user_id' => Auth::user()->id];

        Project::create($message);

        return redirect()->route('project_manager.projects.all');
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

        return redirect()->route('project_manager.projects.all');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->back();
    }
}