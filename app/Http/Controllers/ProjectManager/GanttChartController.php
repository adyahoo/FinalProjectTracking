<?php

namespace App\Http\Controllers\ProjectManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectDetail;
use App\Models\ProjectVersion;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\UserAssignment;

class GanttChartController extends Controller
{
    public function retriveData($project, $version) {
        $project       = Project::where('id', $project)->first();
        $versions      = ProjectVersion::where('id', $version)->first();
        $employees     = Role::whereEmployee()->first()->user;
        $temp          = array();
        $statusOptions = (new ProjectDetail())->statusOption;

        if(isset($project->projectVersions)) {
            foreach($versions->projectDetails as $detail) {
                $names    = array();
                $assignee = $detail->userAssignments()->with('user')->get();
                if($assignee) {
                    foreach($assignee as $assign) {
                        $names[] = $assign->user->name;
                    }
                    $name = implode(',', $names);
                }
                array_push($temp, [
                    'id'         => $detail->id,
                    'text'       => $detail->moduleable->name,
                    'start_date' => Carbon::parse($detail->start_date)->format('d-m-Y H:i:s'),
                    'end_date'   => Carbon::parse($detail->end_date)->format('d-m-Y H:i:s'),
                    'assignee'   => $name,
                    'status'     => $detail->status,
                ]);
            }
            $datas = [
                'data' => $temp
            ];
            $data = json_encode($datas);
            // dd($data);
            return view('project.project_manager.pages.project.gantt', compact('data', 'version', 'project', 'employees', 'statusOptions'));
        }
        $datas = [
            'data' => ''
        ];
        $data = json_encode($datas);
        return view('project.project_manager.pages.project.gantt', compact('data', 'version','project', 'employees', 'statusOptions'));
    }
}
