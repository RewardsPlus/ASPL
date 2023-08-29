<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Imports\AttendanceImport;
use App\Models\Attendance;
use App\Models\Company;
use App\Models\Employee;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    public function company_employee_attendance(Request $req)
    {
        $date=Carbon::now()->format('d-M-Y');
        $companies=Company::orderBy('name')->get();
        if($req->ajax()){
            $employees=Employee::where('company_id',$req->company)->get();
            return DataTables::of($employees)->editColumn('clock_in',function($employee){
                $dt='<input type="time" name="'.$employee->id.'[clock_in]'.'" id="" class="form-control" value="';
                $dt .=$employee->today_attendance?$employee->today_attendance->clock_in:'';
                $dt .='"';
             //    if(isset($employee->today_attendance) and $employee->today_attendance->clock_in!=null){ 
             //    if(Auth::guard(Helper::getGuard())->user()->hasPermissionTo('Bulk Attendance_edit','employee'))
             //    {  
             //    $dt .='readonly';
             //    }
             //    }
                $dt .= '>';
                return $dt;
                })
                ->addIndexColumn()
                ->editColumn('clock_out',function($employee){
                 $dt='<input type="time" name="'.$employee->id.'[clock_out]'.'" id="" class="form-control" value="';
                 $dt .=$employee->today_attendance?$employee->today_attendance->clock_out:'';
                 $dt .='"';
                 $dt .= '>';
                 return $dt;
                 })
                 ->editColumn('status',function($employee){
                    $dt='<select name="'.$employee->id.'[status]'.'" id="" class="form-select">';
                     $dt .='<option value="" disabled selected hidden>Choose Status</option>';
                      $dt .='<option value="present"';
                         if(isset($employee->today_attendance) and $employee->today_attendance->status=='present'){
                             $dt .='selected';
                         }
                         $dt .='>Present</option>';
                         $dt .='<option value="absent"';
                             if(isset($employee->today_attendance) and $employee->today_attendance->status=='absent'){
                                 $dt .='selected';
                             }
                             $dt .='  >Absent</option><option value="paid-leave"';
                             if(isset($employee->today_attendance) and $employee->today_attendance->status=='paid-leave'){
                                 $dt .='selected';
                             }
                             $dt .='  >Paid-Leave</option><option value="unpaid-leave"';
                             if(isset($employee->today_attendance) and $employee->today_attendance->status=='unpaid-leave'){
                                 $dt .='selected';
                             }
                             $dt .='  >Unpaid-Leave</option><option value="half-day"';
                             if(isset($employee->today_attendance) and $employee->today_attendance->status=='half-day'){
                                 $dt .='selected';
                             }
                             $dt .='  >Half-Day</option>';
                             $dt .='</select>'; 
                         
                         return $dt;
                     })
                     ->editColumn('sale',function($employee){
                         $dt='<input type="number" step="0.01" name="'.$employee->id.'[today_sale]" id="" class="form-control" value="';
                         $dt .=$employee->today_attendance?$employee->today_attendance->today_sale:0.0;
                         $dt .='">';
                         return $dt;
                     })
                     ->editColumn('store',function($employee){
                        return $employee->store->detail->code;
                     })
                ->rawColumns(['clock_in','clock_out','status','sale','store'])->make(true);
        }
       return view('admin.company.attendance',compact('date','companies'));
    }

    public function company_bulk_attendance(Request $req)
    {
        $datas=$req->except('_token','DataTables_Table_0_length');
        //  return $datas;
        try{
        foreach($datas as $k=>$d){
            // return $k;
            Attendance::updateOrCreate([
                'employee_id'=>$k,
                'date'=>Carbon::now()->format('Y-m-d'),
            ],[
                'employee_id'=>$k,
                'date'=>Carbon::now()->format('Y-m-d'),
                'clock_in'=>$d['clock_in'],
                'clock_out'=>$d['clock_out'],
                'status'=>$d['status']??'na',
                'today_sale'=>$d['today_sale']
            ]);
        }
        return redirect()->back()->with('toast_success','Attendance marked successfully');
    }
    catch(Exception $ex){
        return redirect()->back()->with('toast_error','Server Error - '.$ex->getMessage());
    }
    }
    public function company_bulk_attendance_get(Request $req)
    {
        $filter=[];
        $company=$req->company;
        $q=Attendance::query();
        if($req->submit=='search' and isset($req->from) and isset($req->to)){
            $filter['from']=$req->from;
            $filter['to']=$req->to;
            $q->whereDate('date', '>=',$req->from)->whereDate('date','<=',$req->to);
            if($req->status){
                $filter['status']=$req->status;
                $q->where('status',$req->status);
            }
        }
        if($req->submit=='excel'){
            $q->whereDate('date', '>=',$req->from)->whereDate('date','<=',$req->to);
            if($req->status){
                $q->where('status',$req->status);
            }
           $attendances= $q->whereIn('employee_id',function($query) use($company){
                $query->select('id')->from('employees')->where('company_id',$company);
            })->get();

        // dd($data);    
        return Excel::download(new AttendanceImport($attendances),'attendance.xlsx');            
        }
        $attendances=$q->whereIn('employee_id',function($query) use($company){
            $query->select('id')->from('employees')->where('company_id',$company);
        })
        ->paginate(10);
        return view('admin.company.export-attendance',compact('attendances','filter'));
    }
}
