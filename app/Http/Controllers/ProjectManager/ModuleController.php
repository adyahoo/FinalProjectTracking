<?php

namespace App\Http\Controllers\ProjectManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Http\Requests\ModuleRequest;

class ModuleController extends Controller
{
    public function index() {
        $modules = Module::all();
        return view('project.project_manager.pages.module.index', compact('modules'));
    }

    public function store(ModuleRequest $request)
    {
        $module = new Module($request->all());
        $module->save();
        return redirect()->route('project_manager.modules.index')->with('success', 'Module created successfully');
    }

    public function show(Module $module)
    {
        return response()->json($module);
    }

    public function update(ModuleRequest $request, Module $module)
    {
        $module->update($request->all());
        return redirect()->route('project_manager.modules.index')->with('success', 'Module updated successfully');
    }

    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('project_manager.modules.index')->with('success', 'Module deleted successfully');
    }
}
