<?php

namespace App\Http\Controllers\admin;

use App\Helpers\Helper;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\PermissionName;
use App\Notifications\PermissionNoti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    // open view for create permission made by super admin
    public function role_permission()
    {
        try{
            $roles=PermissionName::IsActiveAdminRole()->get();
            return view('role_permission.role_permission',compact('roles'));
        }
        catch(Exception $ex){
            Helper::handleError($ex);
        }
        return redirect()->back();
    }

    public function fetch_permission(Request $request)
    {
        try{
            $selectrole=Role::find($request->role);
            $roles=Role::where('created_by',Auth::guard('admin')->user()->id)->where('guard_name',PermissionName::$admin)->get();
            $permissionnames=PermissionName::where('guard_name',PermissionName::$admin)->get();
            return view('role_permission.role_has_permission',compact('roles','permissionnames','selectrole'));
        }
        catch(Exception $ex){
            Helper::handleError($ex);
        }
        return redirect()->back();
    }

    // For assigning the permission.
    public function assign_permission(Request $request)
    {
        $request->validate([
            'roleid'=>'required',
            'rolepermissions'=>'required'
        ]);
        try{
            $role=Role::find($request->roleid);
            $role->syncPermissions($request->rolepermissions);
            Notification::send(Auth::guard(Helper::getGuard())->user(), new PermissionNoti($role));
            return redirect()->back()->with('success','Permission Assigned Successfully');
        }
        catch(Exception $ex){
            Helper::handleError($ex);
        }
        return redirect()->back();
    }
//fetch permission accourding roles
 public function all_permission($id){
    try{
        $id=Crypt::decrypt($id);
        $roles=PermissionName::IsActiveAdminRole()->get();
        $role=Role::find($id);
        return view('role_permission.role_permission',compact('role','roles'));
    }
    catch(Exception $ex){
        Helper::handleError($ex);
    }
    return redirect()->back();
 }

}

