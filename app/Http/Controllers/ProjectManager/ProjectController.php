<?php

namespace App\Http\Controllers\ProjectManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return view('project.project_manager.pages.project.list');
    }

    public function create()
    {
        return view('project.project_manager.pages.project.create');
    }

    public function store(ProjectRequest $request)
    {
        Project::create($request->all());

        return redirect()->route('project_manager.projects.all');
    }
}