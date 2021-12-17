<?php

namespace App\Http\Controllers\ProjectManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAssignment;
use App\Models\ProjectDetail;

class UserAssignmentController extends Controller
{
    public function store(Request $request, ProjectDetail $projectDetail)
    {
        $userAssignment = $request->all();
        $userAssignment += ['project_detail_id' => $projectDetail->id];

        UserAssignment::create($userAssignment);

        return redirect()->back()->with('success', 'Member added successfully');
    }

    public function destroy(UserAssignment $userAssignment)
    {
        $userAssignment->delete();

        return redirect()->back()->with('success', 'Member deleted successfully');
    }
}
