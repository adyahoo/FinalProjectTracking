<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectDetail;
use Carbon\Carbon;
use App\Models\Role;

class GanttChartController extends Controller
{
    public function retriveData(Project $project) {
        $temp      = array();
        $employees = Role::whereEmployee()->first()->user;
        if(isset($project->projectVersions)) {
            foreach($project->projectVersions as $version) {
                foreach($version->projectDetails as $detail) {
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
            }
            $datas = [
                'data' => $temp
            ];
            $data = json_encode($datas);
            // dd($data);
            return view('project.admin.pages.projects.gantt', compact('data', 'project', 'employees'));
        }
        $datas = [
            'data' => ''
        ];
        $data = json_encode($datas);
        return view('project.admin.pages.projects.gantt', compact('data','project', 'employees'));
    }
}
