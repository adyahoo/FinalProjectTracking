<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\User;
use App\Http\Requests\DivisionRequest;

class DivisionsController extends Controller
{
    public function index() {
        $divisions = Division::all();

        return view('project.admin.pages.divisions.index', compact('divisions'));
    }

    public function store(DivisionRequest $request) {
        $division = new Division($request->all());
        $division->save();

        return redirect()->route('admin.divisions.index')->with('success', 'Division created successfully');
    }

    public function show(Division $division) {
        return response()->json($division);
    }

    public function update(DivisionRequest $request, Division $division) {
        $division->update($request->all());

        return redirect()->route('admin.divisions.index')->with('success', 'Division updated successfully');
    }

    public function destroy(Division $division) {
        $check = User::where('division_id', $division->id)->get();

        if($check) {
            return redirect()->route('admin.divisions.index')->with('error', 'This division is still used on a user!');
        }

        $division->delete();
        
        return redirect()->route('admin.divisions.index')->with('success', 'Division deleted successfully');
    }
}
