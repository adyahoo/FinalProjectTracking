<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Http\Requests\RoleRequest;

class RolesController extends Controller
{
    public function index() {
        $roles = Role::all();
        
        return view('project.admin.pages.roles.index', compact('roles'));
    }

    public function store(RoleRequest $request) {
        $role = new Role($request->all());
        $role->save();

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully');
    }

    public function show(Role $role) {
        return response()->json($role);
    }

    public function update(RoleRequest $request, Role $role) {
        $role->update($request->all());

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully');
    }

    public function destroy(Role $role) {
        $check = User::where('role_id', $role->id)->get();
        if($check) {
            return redirect()->route('admin.roles.index')->with('error', 'This role is still used on a user!');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully');
    }
}
