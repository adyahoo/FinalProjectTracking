<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectVersion;

class ProjectVersionController extends Controller
{
    public function index(Project $project)
    {
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();

        return view('project.admin.pages.projects.version.index', compact('project', 'latestVersion'));
    }

    public function detail(Project $project, ProjectVersion $version)
    {
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();

        return view('project.admin.pages.projects.version.detail', compact('latestVersion', 'version'));
    }
}
