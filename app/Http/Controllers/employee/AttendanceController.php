<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\PermissionName;
use App\Helpers\Helper;
use App\Imports\AttendanceImport;
use App\Imports\AttendanceReportImport;
use App\Imports\ConsolidateAttendanceImport;
use App\Models\Employee;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    public function index(Request $req)
    {
        $attendances=Attendance::where('employee_id',Auth::guard(Helper::getGuard())->user()->id)->latest()->paginate(10);
        $today=Attendance::where('employee_id',Auth::guard(Helper::getGuard())->user()->id)->whereDate('date',carbon::now()->format('Y-m-d'))->first();
        return view('employee.attendance.index',compact('attendances','today'));
    }
    public function clock_in()
    {
     $data=Attendance::where('employee_id',Auth::guard(Helper::getGuard())->user()->id)->whereDate('date',Carbon::now()->format('Y-m-d'))->first();
     if($data){
        return redirect()->back()->with('toast_warning','You Have Already Clocked In Today');
     }
     else
     {
        Attendance::create([
            'employee_id'=>Auth::guard(Helper::getGuard())->user()->id,
            'clock_in'=>Carbon::now()->format('h:i'),
            'date'=>Carbon::now()->format('Y-m-d'),
            'status'=>'present'
        ]);
     }
     return redirect()->back()->with('toast_success','Clocked In Successfully');
    }
    public function clock_out()
    {
       $data=Attendance::where('employee_id',Auth::guard(Helper::getGuard())->user()->id)->whereDate('date',Carbon::now()->format('Y-m-d'))->whereNotNull('clock_out')->first();
       if($data){
        return redirect()->back()->with('toast_warning','You Have Already Clocked Out Today');
        }
        else
        {
            Attendance::where(['employee_id'=>Auth::guard(Helper::getGuard())->user()->id])->whereDate('clock_in',Carbon::now())->update([
                'employee_id'=>Auth::guard(Helper::getGuard())->user()->id,
                'clock_out'=>Carbon::now()
                ]);
        }
                return redirect()->back()->with('toast_success','Clocked Out Successfully');
    }

    // bulk attendance
    
    function bulk_attendance(Request $req)
    {
        $datas=$req->except('_token','DataTables_Table_0_length');
        try{
            foreach($datas as $k=>$d){
                Attendance::updateOrCreate([
                    'employee_id'=>$k,
                    'date'=>Carbon::now()->format('Y-m-d'),
                ],[
                    'employee_id'=>$k,
                    'date'=>Carbon::now()->format('Y-m-d'),
                    'clock_in'=>$d['clock_in'],
                    'clock_out'=>$d['clock_out'],
                    'status'=>$d['status']??'na',
                    'today_sale'=>$d['today_sale']??0.00
                ]);
            }
            return redirect()->back()->with('toast_success','Attendance marked successfully');
        }
        catch(Exception $ex){
            return redirect()->back()->with('toast_error','Server Error - '.$ex->getMessage());
        }
    }
    public function bulk_attendance_get(Request $req)
    {
        $filter=[];
        $q= Attendance::query();
        if($req->submit=='excel'){
            $q->whereDate('date', '>=',$req->from)->whereDate('date','<=',$req->to);
            if($req->status){
                $q->where('status',$req->status);
            }
           $attendances= $q->whereIn('employee_id',function($query){
                $query->select('id')->from('employees')->where('store_id',Auth::guard(Helper::getGuard())->user()->store_id);
            })->get();
            $employees=Employee::where('company_id',Auth::guard(Helper::getGuard())->user()->id)->get();
        // dd($data);    
        return Excel::download(new AttendanceReportImport($employees,$attendances,$req->from,$req->to),'attendance.xlsx');            
        }
        if($req->submit=='consolidate-excel'){
            $q->whereDate('date', '>=',$req->from)->whereDate('date','<=',$req->to);
            if($req->status){
                $q->where('status',$req->status);
            }
           $attendances= $q->whereIn('employee_id',function($query){
                $query->select('id')->from('employees')->where('store_id',Auth::guard(Helper::getGuard())->user()->store_id);
            })->get();
            $employees=Employee::where('store_id',Auth::guard(Helper::getGuard())->user()->store_id)->get();
            return Excel::download(new ConsolidateAttendanceImport($employees,$req->from,$req->to),'Consolidate-AttendanceReport.xlsx');         
        }
        if(count($req->all())>0 and $req->submit=='search'){
            $filter['from']=$req->from;
            $filter['to']=$req->to;
            $q->whereDate('date', '>=',$req->from)->whereDate('date','<=',$req->to);
            if($req->status){
                $filter['status']=$req->status;
                $q->where('status',$req->status);
            }
        }
        $attendances=$q->whereIn('employee_id',function($query){
            $query->select('id')->from('employees')->where('store_id',Auth::guard(Helper::getGuard())->user()->store_id);
        })->paginate(10);
        return view('employee.attendance.export',compact('attendances','filter'));
    }
    public function employee_list(Request $req)
    {
        $employees=Employee::where('store_id',Auth::guard(Helper::getGuard())->user()->store_id)->get();
        if($req->ajax()){
            return DataTables::of($employees)->editColumn('clock_in',function($employee){
                $readonly=$employee->today_attendance?(in_array($employee->today_attendance->status,['absent','paid-leave','unpaid-leave'])?'readonly':''):'';
                $dt='<input type="time" name="'.$employee->id.'[clock_in]'.'" id="" class="form-control" value="';
                $dt .=$employee->today_attendance?$employee->today_attendance->clock_in:'';
                $dt .='"';
                if(isset($employee->today_attendance) and $employee->today_attendance->clock_in!=null){ 
                if(Auth::guard(Helper::getGuard())->user()->hasPermissionTo('Bulk Attendance_edit','employee'))
                { 
                }
                else{
                    $dt .='readonly';
                }
                }
                $dt .= $readonly .' >';
                return $dt;
                })
                ->addIndexColumn()
                ->editColumn('clock_out',function($employee){
                    
                $readonly=$employee->today_attendance?(in_array($employee->today_attendance->status,['absent','paid-leave','unpaid-leave'])?'readonly':''):'';
                 $dt='<input type="time" name="'.$employee->id.'[clock_out]'.'" id="" class="form-control" value="';
                 $dt .=$employee->today_attendance?$employee->today_attendance->clock_out:'';
                 $dt .='"';
                 if(isset($employee->today_attendance) and $employee->today_attendance->clock_out!=null){ 
                    if(Auth::guard(Helper::getGuard())->user()->hasPermissionTo('Bulk Attendance_edit','employee'))
                    {  
                    }
                    else{
                        $dt .='readonly';
                    }
                    }
                 $dt .= $readonly .' >';
                 return $dt;
                 })
                 ->editColumn('status',function($employee){
                    
                $readonly=$employee->today_attendance?(in_array($employee->today_attendance->status,['absent','paid-leave','unpaid-leave'])?'readonly':''):'';
                    $dt='<select name="'.$employee->id.'[status]'.'" id="" class="form-select"';
                    if(isset($employee->today_attendance) and $employee->today_attendance->status!=null ){ 
                        if(Auth::guard(Helper::getGuard())->user()->hasPermissionTo('Bulk Attendance_edit','employee'))
                        {  
                        }
                        else{
                            $dt .=$employee->today_attendance->status=='na'?'':'disabled';
                        }
                        }
                     $dt .= $readonly .' >';
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
                    
                $readonly=$employee->today_attendance?(in_array($employee->today_attendance->status,['absent','paid-leave','unpaid-leave'])?'readonly':''):'';
                    $dt='<input type="number" step="0.1" name="'.$employee->id.'[today_sale]" id="" class="form-control" value="';
                    $dt .=$employee->today_attendance?$employee->today_attendance->today_sale:'0.00';
                    $dt .='"'.$readonly .' >';
                    return $dt;
                })
                ->editColumn('emp_code',function($employee){
                    return $employee->employee->emp_code??'';
                })
                ->rawColumns(['clock_in','clock_out','status','sale'])->make(true);         
        }
        $date=Carbon::now()->format('d-m-Y');
        return view('employee.attendance.bulk',compact('employees','date'));
    }

}
