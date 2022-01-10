<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectDetail;
use App\Models\ProjectVersion;
use App\Traits\ProjectVersionTrait;
use Carbon\Carbon;
use Auth;

class GanttChartController extends Controller
{
    use ProjectVersionTrait;

    public function retriveData(Project $project, $version) {
        $versions        = ProjectVersion::where('project_id', $project)->latest()->get();
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
                    'id'          => $detail->id,
                    'text'        => $detail->moduleable->name . ' v' . $detail->projectVersion->version_number,
                    'start_date'  => Carbon::parse($detail->start_date)->format('d-m-Y H:i:s'),
                    'end_date'    => Carbon::parse($detail->end_date)->format('d-m-Y H:i:s'),
                    'assignee'    => $name,
                    'status'      => $detail->status,
                    'is_assigned' => $detail->userAssignments()->where('user_id', Auth::user()->id)->count()
                ]);
            }
            $datas = [
                'data' => $temp
            ];
            $data = json_encode($datas);
            return view('project.employee.pages.project.gantt', compact('data', 'project', 'version', 'statusOptions', 'selectedVersion'));
        }
        $datas = [
            'data' => ''
        ];
        $data = json_encode($datas);
        return view('project.employee.pages.project.gantt', compact('data','project', 'version', 'statusOptions'));
    }
}
