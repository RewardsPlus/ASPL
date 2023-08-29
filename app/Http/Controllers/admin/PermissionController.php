<?php

namespace App\Http\Controllers\admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\PermissionName;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $permissions = PermissionName::where('guard_name',PermissionName::$admin)->latest()->get();
            return view('role_permission.permission',compact('permissions'));
        }
        catch(Exception $ex){
            Helper::handleError($ex);
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'permission' => 'required',
        ]);
        try{
        $perm = PermissionName::create(['permission_name'=>$request->permission,'guard_name'=>PermissionName::$admin]);
        if(isset($perm))
        {
            $permission = Permission::create(['name' => $request->permission, 'guard_name'=>$perm->guard_name,'permission_name_id' => $perm->id]);
            Permission::create( ['name' => $request->permission.'_create','guard_name'=>$perm->guard_name, 'permission_name_id' => $perm->id]);
            Permission::create( ['name' => $request->permission.'_read', 'guard_name'=>$perm->guard_name,'permission_name_id' => $perm->id]);
            Permission::create( ['name' => $request->permission.'_edit','guard_name'=>$perm->guard_name, 'permission_name_id' => $perm->id]);
            Permission::create( ['name' => $request->permission.'_delete','guard_name'=>$perm->guard_name, 'permission_name_id' => $perm->id]);
            return isset($permission) ? redirect()->back()->with('success','Permission has been created successfully.') : redirect()->back()->with('error','Permission is not created');
        }
        else {
            return redirect()->back()->with('error','Something went wrong !');
        }
    }
    catch(Exception $ex){
        Helper::handleError($ex);
    }
    return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
