<?php

namespace App\Http\Controllers\company;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\PermissionName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_view()
    {
        return view('auth.login');
    }
    public function login(Request $req)
    {
        $req->validate([
            'email' => 'required|exists:companies,email',
            'password' => 'required|min:8'
        ]);

        if (Auth::guard(PermissionName::$company)->attempt(['email' => $req->email, 'password' => $req->password, 'remember_token' => $req->remember_me])) {
            return redirect()->route('company.dashboard')->with('toast_success', 'Welcome ' . Auth::guard(Helper::getGuard())->user()->email);
        } else {
            return redirect()->back()->with('toast_error', 'Invalid Credentials');
        }
    }

    //logout
    public function logout()
    {
        Auth::guard(PermissionName::$company)->logout();
        return redirect()->route(PermissionName::$company.'.auth.login-view')->with('toast_success', 'Logged Out');
    }
}
