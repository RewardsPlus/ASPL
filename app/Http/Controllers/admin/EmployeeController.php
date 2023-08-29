<?php

namespace App\Http\Controllers\admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $data=Company::get();
        if($req->ajax()){
            $employees=Employee::get();
            return DataTables::of($employees)->editColumn('designation',function($employee){
                $role='';
                foreach($employee->getRoleNames() as $rolename) 
                {
                               
                              $role .= Helper::roleName($rolename).',';
                }                
                  return $role;
            })
            ->addIndexColumn()
            ->editColumn('company',function($employee){return $employee->company->name;})
            ->editColumn('store',function($employee){return $employee->store->name;})
            ->editColumn('store_code',function($employee){return $employee->store->detail->code;})
            ->addColumn('action', function($employee){
                $btn='
                <div class="dropdown">
                                    <a class="btn btn-info dropdown-toggle btn-square text-light" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                     action
                                    </a>
                                  
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                      <li><a class="dropdown-item assign-role" href="#" data-employee_id="'. $employee->id.'"><i class="fa fa-rocket text-warning"></i> Assign Role</a></li>
                                      <li><a class="dropdown-item" href="#"><i class="fa fa-pencil-square-o text-primary"></i> Edit</a></li>
                                      <li><a class="dropdown-item" href="#"><i class="fa fa-trash-o text-danger"></i> Delete</a></li>
                                    </ul>
                                  </div>
                ';
               $btn .='</form>
                </div>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('employee.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
