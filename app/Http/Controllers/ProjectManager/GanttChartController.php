<?php

namespace App\Http\Controllers\ProjectManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectDetail;
use Carbon\Carbon;

class GanttChartController extends Controller
{
    public function retriveData(Project $project) {
        $temp    = array();
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
            return view('project.project_manager.pages.project.gantt', compact('data', 'project'));
        }
        $datas = [
            'data' => ''
        ];
        $data = json_encode($datas);
        return view('project.project_manager.pages.project.gantt', compact('data','project'));
    }

    public function changeStatus(Request $request, $id){
        $detail = ProjectDetail::find($id);
        $detail->update([
            'status' => $request->status
        ]);
        return redirect()->back()->with('success', 'Status has been changed');
    }
}