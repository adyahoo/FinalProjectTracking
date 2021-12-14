<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\PasswordRequest;

class CreatePasswordController extends Controller
{
    public function create($mail) {
        $user = User::where('email', decrypt($mail))->whereNull('password')->first();

        if ($user == null) {
            return redirect(route('login'))->with('error', 'Password Already Created!');
        }

        return view('auth.create-password', compact('user'));
    }

    public function store(PasswordRequest $request, User $user) {
        $user->update(['password' => $request->password]);
        
        return redirect(route('login'))->with('success', 'Password Created Successfully!');
    }
}
