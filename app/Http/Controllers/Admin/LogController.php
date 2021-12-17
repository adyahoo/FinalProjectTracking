<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function index(){
        return view('project.admin.pages.logs.index');
    }

    public function show($log){
        $logs = Activity::where('log_name', $log)->get();
        return view('project.admin.pages.logs.detail', compact('logs'));
    }
}
