<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageSetting;
use App\Http\Requests\PageSettingRequest;

class PageSettingController extends Controller
{
    public function index() {
        $pageSetting = PageSetting::first();
        return view('project.admin.pages.setting.index', compact('pageSetting'));
    }

    public function store(PageSettingRequest $request) {
        $pageSetting = PageSetting::first();

        if($pageSetting) {
            $pageSetting->update($request->all());
        } else {
            PageSetting::create($request->all());
        }

        return redirect()->back()->with('success', 'Page Setting Updated Successfully');
    }
}
