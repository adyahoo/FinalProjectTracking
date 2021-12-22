<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectVersionRequest;
use App\Models\Project;
use App\Models\ProjectVersion;
use App\Traits\VersionValidationTrait;

class ProjectVersionController extends Controller
{
    use VersionValidationTrait;

    public function index(Project $project) {
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();

        return view('project.admin.pages.projects.version.index', compact('project', 'latestVersion'));
    }

    public function detail(Project $project, ProjectVersion $projectVersion) {
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();

        return view('project.admin.pages.projects.version.detail', compact('latestVersion', 'projectVersion'));
    }

    public function create(Project $project) {
        $latestVersion = ProjectVersion::where('project_id', $project->id)->latest()->first();
        $versionFetch  = explode('.', $latestVersion->version_number);

        return view('project.admin.pages.projects.version.create', compact('latestVersion', 'project', 'versionFetch'));
    }

    public function store(ProjectVersionRequest $request, Project $project) {
        $latestVersion     = ProjectVersion::where('project_id', $project->id)->latest()->first();
        $newVersion        = $request->major . '.' . $request->minor . '.' . $request->patch;
        $versionValidation = $this->versionValidation($newVersion, $latestVersion);

        if(!empty($versionValidation))
            return back()->withErrors(['version_number' => $versionValidation]);

        $projectVersion = $request->all();
        $projectVersion += ['project_id' => $project->id];
        $projectVersion += ['version_number' => $newVersion];

        ProjectVersion::create($projectVersion);

        return redirect()->route('admin.admin_projects.version.index', $project)->with('success', 'Project created successfully');
    }

    public function edit(ProjectVersion $projectVersion) {
        $latestVersion = ProjectVersion::where('project_id', $projectVersion->project_id)->latest()->first();

        return view('project.admin.pages.projects.version.edit', compact('projectVersion', 'latestVersion'));
    }

    public function update(ProjectVersionRequest $request, ProjectVersion $projectVersion) {
        $projectVersionUpdate = $request->all();
        $projectVersionUpdate += ['version_number' => $projectVersion->version_number];

        $projectVersion->update($projectVersionUpdate);

        return redirect()->route('admin.admin_projects.version.index', $projectVersion->project_id)->with('success', 'Project version updated successfully');
    }

    public function destroy(ProjectVersion $projectVersion) {
        $version->delete();

        return redirect()->back()->with('success', 'Project version deleted successfully');
    }
}
