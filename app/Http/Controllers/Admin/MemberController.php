<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MemberRequest;
use App\Models\User;
use App\Models\Role;
use App\Models\Division;
use App\Traits\CreatePasswordTrait;

class MemberController extends Controller
{
    use CreatePasswordTrait;

    public function index() {
        $roles     = Role::all();
        $divisions = Division::all();
        $members   = User::all();

        return view('project.admin.pages.members.index', compact('members', 'roles', 'divisions'));
    }

    public function store(MemberRequest $request) {
        $member = new User($request->all());
        
        if($member->save()){
            $this->sendCreatePassLink($request->email, $request->name);
        }

        return redirect()->route('admin.members.index')->with('success', 'Member has been added successfully');
    }

    public function show(User $member)
    {
        return response()->json($member);
    }

    public function update(MemberRequest $request, User $member)
    {
        $member->update($request->all());

        return redirect()->route('admin.members.index')->with('success', 'Member has been updated successfully');
    }

    public function destroy(User $member)
    {
        $member->delete();
        
        return redirect()->route('admin.members.index')->with('success', 'Member has been deleted successfully');
    }
}
