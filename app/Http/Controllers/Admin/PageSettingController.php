<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageSettingController extends Controller
{
    public function index(){
        return view('project.admin.pages.setting.index');
    }

    
}
