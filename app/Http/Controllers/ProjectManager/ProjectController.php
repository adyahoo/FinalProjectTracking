<?php

namespace App\Http\Controllers\ProjectManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return view('project_manager.pages.project.list');
    }

    public function create()
    {
        return view('project_manager.pages.project.create');
    }
}
