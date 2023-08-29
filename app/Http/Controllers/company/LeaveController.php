<?php

namespace App\Http\Controllers\company;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function leave_application()
    {
        $employee=Auth::guard(Helper::getGuard())->user()->employeeable()->pluck('id')->toArray();
        $leaves=Leave::whereIn('leaveable_id',$employee)->get();
       return view('company.leave_application',compact('leaves'));
    }
    public function leave_status(Request $req)
    {
       Leave::find($req->application_id)->update(['status'=>$req->status]);
       return redirect()->back()->with('toast_success','Leave status update to '.$req->status);
    }
}
