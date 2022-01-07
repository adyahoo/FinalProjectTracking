<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Models\User;

class LogController extends Controller
{
    public function index() {
        return view('project.admin.pages.logs.index');
    }

    public function show($log) {
        $logs = Activity::where('log_name','like', '%'. $log.'%')
                    ->orderBy('created_at','desc')
                    ->get();
                
        return view('project.admin.pages.logs.detail', compact('logs','log'));
    }
}
