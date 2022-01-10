<?php

namespace App\Http\Controllers\ProjectManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectDetail;
use App\Models\ProjectVersion;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserAssignment;
use App\Traits\ProjectVersionTrait;

class GanttChartController extends Controller
{
    use ProjectVersionTrait;

    public function retriveData(Project $project, $version) {
        $versions        = ProjectVersion::where('id', $version)->latest()->get();
        $employees       = User::whereEmployee()->get();
        $temp            = array();
        $statusOptions   = (new ProjectDetail())->statusOption;
        $selectedVersion = $this->selectedVersion($versions, $version, $project);

        if(isset($project->projectVersions)) {
            foreach($selectedVersion->projectDetails as $detail) {
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
                    'text'       => $detail->moduleable->name . ' v' . $detail->projectVersion->version_number,
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
            return view('project.project_manager.pages.project.gantt', compact('data', 'version', 'project', 'employees', 'statusOptions', 'selectedVersion'));
        }
        $datas = [
            'data' => ''
        ];
        $data = json_encode($datas);
        return view('project.project_manager.pages.project.gantt', compact('data', 'version','project', 'employees', 'statusOptions'));
    }
}
