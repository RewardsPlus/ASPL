<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionName;
use App\Models\Company;

class AuthController extends Controller
{
    public function login_view()
    {
        return view('auth.login');
    }
    public function login(Request $req)
    {
        $req->validate([
            'email' => 'required|exists:employees,email',
            'password' => 'required|min:8'
        ]);

        if (Auth::guard(PermissionName::$employee)->attempt(['email' => $req->email, 'password' => $req->password,'login_allow'=>1, 'remember_token' => $req->remember_me])) {
            $type = get_class(Auth::guard(PermissionName::$employee)->user()->employeeable);
            if ($type == get_class(new Company())) {
                return redirect()->route('employee.company-dashboard')->with('toast_success', 'Welcome ');
            }
        } else {
            return redirect()->back()->with('toast_error', 'Invalid Credentials');
        }
    }

    //logout
    public function logout()
    {
        Auth::guard(PermissionName::$employee)->logout();
        return redirect()->route(PermissionName::$employee.'.auth.login-view')->with('toast_success', 'Logged Out');
    }
}
