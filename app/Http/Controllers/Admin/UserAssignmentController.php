<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAssignment;
use App\Models\ProjectDetail;

class UserAssignmentController extends Controller
{
    public function store(Request $request, ProjectDetail $projectDetail)
    {
        $check = UserAssignment::where('project_detail_id',$projectDetail->id)->where('user_id', $request->user_id)->first();
        if (!$check) {
            $userAssignment = $request->all();
            $userAssignment += ['project_detail_id' => $projectDetail->id];

            UserAssignment::create($userAssignment);
            return redirect()->back()->with('success', 'Member added successfully');
        }

        return redirect()->back()->with('error', 'This Member already added');
    }

    public function destroy(UserAssignment $userAssignment)
    {
        $userAssignment->delete();

        return redirect()->back()->with('success', 'Member deleted successfully');
    }
}
