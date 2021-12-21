<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Models\Project;
use App\Models\ProjectDetail;

class ProjectLogController extends Controller
{
    public function index(Project $project)
    {
        $projectDetail = new ProjectDetail();
        $logs          = Activity::where('subject_type', get_class($projectDetail))->get();

        return view('project.employee.pages.project.log.index', compact('project', 'logs'));
    }
}
