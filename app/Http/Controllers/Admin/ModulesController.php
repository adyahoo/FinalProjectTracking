<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\ProjectDetail;
use App\Http\Requests\ModuleRequest;

class ModulesController extends Controller
{
    public function index() {
        $modules = Module::all();
        
        return view('project.admin.pages.modules.index', compact('modules'));
    }

    public function store(ModuleRequest $request) {
        $module = new Module($request->all());
        $module->save();

        return redirect()->route('admin.modules.index')->with('success', 'Module created successfully');
    }

    public function show(Module $module) {
        return response()->json($module);
    }

    public function update(ModuleRequest $request, Module $module) {
        $module->update($request->all());

        return redirect()->route('admin.modules.index')->with('success', 'Module updated successfully');
    }

    public function destroy(Module $module) {
        $check = ProjectDetail::where('moduleable_type', 'App\Models\Module')->where('moduleable_id', $module->id)->get();
        
        if(!$check){
            $module->delete();

            return redirect()->route('admin.modules.index')->with('success', 'Module deleted successfully');
        }
        
        return redirect()->route('admin.modules.index')->with('error', 'This module is still used on a project!');
    }
}
