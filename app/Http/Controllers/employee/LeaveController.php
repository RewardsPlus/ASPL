<?php

namespace App\Http\Controllers\employee;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves=Auth::guard(Helper::getGuard())->user()->leaves()->latest()->paginate(10);
        return view('employee.leave',compact('leaves'));
    }
    public function store(Request $req)
    {
       $req->validate([
        'subject'=>'required|string',
        'from'=>'required|date|after:yesterday',
        'to'=>'required|date|after:yesterday',
       ]);
       if(Auth::guard(Helper::getGuard())->user()->leaves()->where('leave_start',$req->from)->exists()){
            return redirect()->back()->with('toast_warning','Leave Already Applied');
       }
       else
       {
        $res=Auth::guard(Helper::getGuard())->user()->leaves()->create([
            'subject'=>$req->subject,
            'leave_start'=>$req->from,
            'leave_end'=>$req->to,
            'desc'=>$req->desc??'',
            'status'=>Leave::$pending,
        ]);
       }
       if($res){
        return redirect()->back()->with('toast_success','Leave Apply Successfully');
       }
       return redirect()->back()->with('toast_error','Something Went Wrong');
    }
}
