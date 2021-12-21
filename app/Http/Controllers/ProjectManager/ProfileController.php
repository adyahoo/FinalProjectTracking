<?php

namespace App\Http\Controllers\ProjectManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use App\Models\Blog;
use App\Models\UserAssignment;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Traits\NumberFormatTrait;

class ProfileController extends Controller
{
    use NumberFormatTrait;
    
    public function index() {
        $blogCount       = Blog::where('user_id', Auth::user()->id)->count();
        $blogViewCount   = $this->getAmount(Blog::where('user_id', Auth::user()->id)->sum('view_count'));
        $assignmentCount = $this->getAmount(UserAssignment::where('user_id', Auth::user()->id)->count());
        return view('project.project_manager.pages.dashboard.profile', compact('blogCount', 'blogViewCount', 'assignmentCount'));
    }

    public function changePasswordPages() {
        return view('project.project_manager.pages.dashboard.change_password');
    }

    public function changePassword(PasswordRequest $request) {
        $check = Hash::check($request->old_password, Auth::user()->password);

        if($check) {
            Auth::user()->update([
                'password' => $request->password
            ]);
        } else {
            return redirect()->back()->with('error', 'Your old password is incorrect!');
        }

        return redirect()->back()->with('success', 'Password Changed Successfully!');
    }

    public function editProfile(User $user, ProfileRequest $request) {
        $user->update($request->all());

        return redirect()->back()->with('success', 'Profile Updated Successfully!');
    }
}
