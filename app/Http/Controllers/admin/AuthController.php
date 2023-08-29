<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionName;
use App\Helpers\Helper;

class AuthController extends Controller
{
    public function login_view()
    {
        return view('auth.login');
    }
    public function login(Request $req)
    {
        $req->validate([
            'email' => 'required|exists:admins,email',
            'password' => 'required|min:8'
        ]);

        if (Auth::guard(PermissionName::$admin)->attempt(['email' => $req->email, 'password' => $req->password, 'remember_token' => $req->remember_me])) {
            return redirect()->route('admin.dashboard')->with('toast_success', 'Welcome ' . Auth::guard(Helper::getGuard())->user()->email);
        } else {
            return redirect()->back()->with('toast_error', 'Invalid Credentials');
        }
    }

    //logout
    public function logout()
    {
        Auth::guard(PermissionName::$admin)->logout();
        return redirect()->route(PermissionName::$admin.'.auth.login-view')->with('toast_success', 'Logged Out');
    }
}
