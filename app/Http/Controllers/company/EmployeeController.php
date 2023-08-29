<?php

namespace App\Http\Controllers\company;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyDetail;
use App\Models\Employee;
use App\Models\EmployeeDetail;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
      // set_time_limit(300);
        // $employees=Auth::guard(Helper::getGuard())->user()->employeeable()->paginate(10);
        $data=Company::where('id',Auth::guard(Helper::getGuard())->user()->id)->get();
        $roles=Role::where('createable_type',get_class(new Company()))->where('createable_id',Auth::guard(Helper::getGuard())->user()->id)->get();
        if($req->ajax()){
            $employees=Auth::guard(Helper::getGuard())->user()->employeeable()->get();
            return DataTables::of($employees)->editColumn('designation',function($employee){
                $role='';
                foreach($employee->getRoleNames() as $rolename) 
                {
                               
                              $role .= Helper::roleName($rolename).',';
                }                
                  return $role;
            })
            ->addIndexColumn()
            ->editColumn('emp_code',function($employee){return $employee->employee->emp_code??'';})
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
                                      <li><a class="dropdown-item employee_route"  href="#"  data-url="'.route('company.employee.edit', $employee->id).'"  data-bs-toggle="modal" data-bs-target="#updateemployee" ><i class="fa fa-pencil-square-o text-primary"></i> Edit</a></li>
                                      <li><a href="javascript:void(0)" class="dropdown-item  change-password" data-employee_id="'. $employee->id.'"><i class="fa fa-key text-danger"></i> Change Password</a></li>
                                      <li><a class="dropdown-item" href="#"><i class="fa fa-trash-o text-danger"></i> Delete</a></li>
                                    </ul>
                                  </div>
                ';
               $btn .='</form>
                </div>';
                return $btn;
            })
            ->addcolumn('login_allow',function($employee){
              $btn='<div class="flex-grow-1 text-end icon-state">
              <label class="switch">
                <input type="checkbox" onclick="change_login_status('.$employee->id.',';
                $btn .=$employee->login_allow?0:1;
                $btn .=')"';
                $btn .=$employee->login_allow?'checked=""':'';
                $btn .='><span class="switch-state';
                $btn .='"></span>
              </label>
            </div>';
            return $btn;
            })
            ->rawColumns(['action','login_allow'])
            ->make(true);
        }
        return view('employee.list',compact('data','roles'));
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
    public function store(Request $req)
    {
      $req->validate([
        'pan_no' => 'required',
        'aadhar_no' => 'required',
        'contact' => 'required',
        'emp_code'=>'required|unique:employee_details,emp_code,'.Employee::where('email',$req->email)->first()->employee->id
    ]);
          $data=Auth::guard(Helper::getGuard())->user()->employees()->updateOrCreate([
            'email'=>$req->email,
            'employeeable_id'=>$req->company_id,
          ],[
            'name'=>$req->name,
            'email'=>$req->email,
            'mobile'=>$req->contact,
            'password'=>Hash::make($req->password??12346578),
            'company_id'=>$req->company_id,
            'store_id'=>$req->store_id,
            'employeeable_type'=>get_class(new Company()),
            'employeeable_id'=>$req->company_id,
            'uniqid'=>Str::orderedUuid(),
          ]);
          $d=EmployeeDetail::updateOrCreate([
            'emp_id'=>$data->id,
          ],[
            'emp_id'=>$data->id,
            'emp_type'=>$req->emp_type,
            'emp_code'=>$req->emp_code,
            'adhar_number'=>$req->aadhar_no,
            'pan_number'=>$req->pan_no,
            'account_number'=>$req->account_no,
            'ifsc_code'=>$req->ifsc_code,
            'photo'=>$req->hasFile('photo')?Helper::Image('Employee/photo',$req->photo,'photo'):'',
            'adhar_img'=>$req->hasFile('aadhar')?Helper::Image('Employee/aadhar',$req->aadhar,'aadhar'):'',
            'address_proof'=>$req->hasFile('address_proof')?Helper::Image('Employee/address_proof',$req->address_proof,'address_proof'):'',
            'pancard_img'=>$req->hasFile('pancard')?Helper::Image('Employee/pancard',$req->pancard,'pancard'):'',
            'other_img'=>$req->hasFile('other')?Helper::Image('Employee/other',$req->other,'other'):'',
            'address'=>$req->address,
          ]);
          // return $d;
          if($d and $data)
          {
            if($req->emp_type){
            $data->assignRole($req->emp_type);
            }
            return redirect()->back()->with('toast_success','Employee Register Successfully');
          }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee=Employee::find($id);
        $roles=Auth::guard(Helper::getGuard())->user()->rolecreated;
        $assingedRoles=$employee->getRoleNames();
        return view('employee.employee-has-roles',compact('employee','roles','assingedRoles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee=Employee::find($id);
        $company =Company::where('id',Auth::guard(Helper::getGuard())->user()->id)->get();
        $roles=Role::where('createable_type',get_class(new Company()))->where('createable_id',Auth::guard(Helper::getGuard())->user()->id)->get();
        return view('employee.edit',compact('employee','company','roles'));
    }
    public function fetchcompany($id)
    {
        $user = Company::with('store')->find($id);
        //dd($user->store);
        $html ='<option selected disabled hidden>Select your Store</option>';
        foreach($user->store as $dt){
            $html.="<option value=".$dt->id.">".$dt->name."</option>";
        }
        return $html;
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
        Employee::find($id)->delete();
        return redirect()->back()->with('toast_success','Empployee Deleted Successfully');
    }

    // old fetch sales employee
    public function fetch_sales_employee(Request $request)
    {
        $notfound=[];
        $oldcompany=DB::connection('oldmysql')->table('company')->where('email',Auth::guard(Helper::getGuard())->user()->email)->first();
        $data=DB::connection('oldmysql')->table('salesperson')->where('company_id',$oldcompany->id)->get();
       foreach($data as $emp){
        $d=DB::connection('oldmysql')->table('employee')->whereRaw('FIND_IN_SET("'.$emp->id.'",sales_person_id)')->first();
        $oldcmp=DB::connection('oldmysql')->table('company')->find($emp->company_id);
        if($d){
            $oldstore=DB::connection('oldmysql')->table('store')->find($d->store_id);
        }
        $newcmp=Company::where('email',$oldcmp->email)->first();
        $newstore=NULL;
        if(isset($oldstore) and $oldstore)
        {
        $newstore=Store::where('email',$oldstore->email)->first();
        }
        if($newstore){
            $newemp=  Auth::guard(Helper::getGuard())->user()->employees()->updateOrCreate(['email'=>$emp->email],[
                    'name'=>$emp->name??'',
                    'email'=>$emp->email??'',
                    'mobile'=>$emp->contact??'', 
                    'password'=>Hash::make($emp->password??12346578),
                    'creatable_type'=>get_class(new Company()),
                    'creatable_id'=>$newcmp->id,
                    'uniqid'=>$emp->uniqid??time().rand(111,999),
                    'company_id'=>$newcmp->id??'',
                    'store_id'=>$newstore->id??'',
                ]);
                $newemp->assignRole($newcmp->id.'_Sales Manager');
        }
        else{
            $notfound[]=$emp;
        }
       }
      Session::flash('error','These Employee can\'t be register'.json_encode($notfound));
      return redirect()->back()->with('toast_success','Data Imported');
    }

    // Fetch old Employee

    public function fetch_old_employees()
    {
        $oldcmp=DB::connection('oldmysql')->table('company')->where('email',Auth::guard(Helper::getGuard())->user()->email)->first();
       $employees=DB::connection('oldmysql')->table('employee')->where('company_id',$oldcmp->id)->get();
      foreach($employees as $emp){
        $oldcmp=DB::connection('oldmysql')->table('company')->find($emp->company_id);
        $oldstore=DB::connection('oldmysql')->table('store')->find($emp->store_id);
        $newcmp=Company::where('email',$oldcmp->email)->first();
        $newstore=Store::where('email',$oldstore->email)->first();
        $oldstcmp=[];
        if($newcmp->email and $newstore->email)
        {
            $data=Auth::guard(Helper::getGuard())->user()->employees()->updateOrCreate(['email'=>$emp->email],[
                'name'=>$emp->name??'',
                'email'=>$emp->email??'',
                'mobile'=>$emp->contact??'', 
                'password'=>Hash::make($emp->password??12346578),
                'employeeable_type'=>get_class(new Company()),
                'employeeable_id'=>$newcmp->id,
                'uniqid'=>$emp->uniqid??'',
                'company_id'=>$newcmp->id??'',
                'store_id'=>$newstore->id??'',
                'uan_no'=>$emp->uan_no??0
            ]);
            if($data){
              EmployeeDetail::updateOrCreate(['emp_id'=>$data->id],[
                'emp_type'=>$emp->emp_type,
                'emp_code'=>$emp->emp_code,
                'adhar_number'=>$emp->aadhar_no,
                'pan_number'=>$emp->pan_no,
                'account_number'=>$emp->account_no,
                'ifsc_code'=>$emp->ifsc_code,
                'photo'=>$emp->photo,
                'adhar_img'=>$emp->aadhar,
                'address'=>$emp->address,
                'emp_id'=>$data->id,
                'address_proof'=>$emp->address_proof,
                'pancard_img'=>$emp->pancard,
                'other_img'=>$emp->other
              ]);
            }
        }
        else
        {
            $oldstcmp[]=[$oldcmp->email=>$oldstore->email];
        }
       
      }
      Session::flash('warning',json_encode($oldstcmp));
      return redirect()->back()->with('toast_success','Employee Fetch successfully');
    }
    
    public function employee_login_status($eid,$status)
    {
        $e=Employee::find($eid)->update([
          'login_allow'=>$status
        ]);
        if($e){
          Session::flash('toast_success','Status Updated');
        }
        else
        {
          Session::flash('toast_error','Status Can\'t update');
        }
        return redirect()->back();
    }

    public function change_password(Request $req)
    {
      $req->validate([
        'employee_id'=>'required|exists:employees,id',
        'password'=>'required|min:8'
      ]);
      $res=Employee::find($req->employee_id)->update([
        'password'=>Hash::make($req->password)
      ]);
      if($res){
        Session::flash('toast_success','Password Change');
      }
      else
      {
        Session::flash('toast_error','Password not Changed right now');
      }
      return redirect()->back();
    }
}
