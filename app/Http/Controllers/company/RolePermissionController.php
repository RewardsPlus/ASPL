<?php

namespace App\Http\Controllers\company;

use App\Helpers\Helper;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
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
            $roles=Role::where('guard_name',PermissionName::$employee)->where(['createable_type'=>get_class(new Company()),'ownerable_id'=>Auth::guard(Helper::getGuard())->user()->id])->get();
            return view('role_permission.role_permission',compact('roles'));
        }
        catch(Exception $ex){
            return $ex->getMessage();
            Helper::handleError($ex);
        }
        return redirect()->back();
    }

    public function fetch_permission(Request $request)
    {
        try{
            $selectrole=Role::find($request->role);
            $roles=   $roles=Auth::guard(Helper::getGuard())->user()->rolecreated;
            $permissionnames=PermissionName::where('guard_name',PermissionName::$employee)->get();
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

 public function assign_roles(Request $req)
 {
    $req->validate([
        'employee'=>'required|exists:employees,id',
        'roles'=>'array',
        'roles.*'=>'required|string'

    ]);
    $res=Employee::find($req->employee)->assignRole($req->roles);
    if($res){
        return redirect()->back()->with('success','Role Assigned Successfully');
    }
    else
    {
        return redirect()->back()->with('error','Role Can\'t Assign');
    }
 }
 // Revoke role
 public function revoke_role($eid,$role)
 {
    try{
    $emp=Employee::find($eid);
    if($emp){
        $emp->removeRole($role);
    }
    return redirect()->back()->with('success','Role revoke from user successfully');
    }
    catch(Exception $ex){
        return redirect()->back()->with('error',$ex->getMessage());
    }
 }
}

