<?php

namespace App\Http\Controllers\company;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\StoreHasPincode;
use App\Models\Pincode;
use App\Models\Store;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class PincodeController extends Controller
{
    public function view_pincode(Request $req){
        if($req->ajax()){
            $store_id=$req->store_id;
            $pincodes=Pincode::where('store_id',$store_id)->get();
            return DataTables::of($pincodes)
            ->editColumn('delivery_time',function($pincode) use ($store_id){
                $d='<form action="';
                $d .=url('delivery/update-delivery');
                $d .='" method="post">';
                $d .='<input type="hidden" name="_token" value="'.csrf_token().'">';
                $d .='<input type="hidden" name="store_id" value="'.$store_id.'">';
                $d .="<input type='hidden' name='pincode_id' value='".$pincode->id."'>".'<div class="input-group">';
               $d .= '<input type="text" class="form-control" name="min_days" value="'.$pincode->min_days.'" required pattern="[0-9]*" title="Delivery Time should be as \'2\' days">';
               $d .= '<input type="text" class="form-control" name="max_days" value="'.$pincode->max_days.'" required pattern="[0-9]*" title="Delivery Time should be as \'23\' days">';
               $d .= '<input type="time" class="form-control" name="shipment_pickup_time" value="'.$pincode->pickup_time.'" required title="Delivery Time should be as H:i ">';
               $d .='<div class="input-group-append"><button class="btn  btn-light btn-square" type="submit"><i class="fa fa-check-circle-o  fa-2x text-success"></i></button><a class="btn btn-light btn-square" href="';
               $d .=$pincode->id?route('company.delivery.del-delivery',$pincode->id):'#';
               $d .='"><i class="fa fa-trash  fa-2x text-danger"></i></a></div></div></form>';
               return $d;
            })
            ->addIndexColumn()
            ->addColumn('pincode', function ($row) {
                return $row->pincode;
            })
            ->rawColumns(['delivery_time','pincode'])
            ->make(true);
        }
        $stores=Store::where('company_id',Auth::guard(Helper::getGuard())->user()->id)->get();
        return view('company.pincode',compact('stores'));

    }

    public function update_delivery(Request $req){
        // $res=StoreHasPincode::updateOrCreate(['store_id'=>$req->store_id,'pincode_id'=>$req->pincode_id],[
        //     'store_id'=>$req->store_id,
        //     'pincode_id'=>$req->pincode_id,
        //     'min_day'=>$req->min_day,
        //     'max_day'=>$req->max_day,
        //     'shipment_pickup_time'=>$req->shipment_pickup_time
        // ]);
        // if($res){
        //     Session::flash('success','Delivery Time Updated');
        // }
        // else
        // {
        //     Session::flash('error','Delivery Not Updated');
        // }
        $pincode = Pincode::where('id', $req->pincode_id)->first();
        $pincode->min_days = $req->min_days;
        $pincode->max_days = $req->max_days;
        $pincode->save();
        Session::flash('success','Delivery Time Updated');
        return redirect()->back()->with('store_id',$req->store_id);
    }

    public function new_pincode() {
        $stores = Store::where('company_id',Auth::guard(Helper::getGuard())->user()->id)->get();
        return view('company.add-new-pincode', compact('stores'));
    }

    public function save_new_pincode(Request $request) {
        $data = $request->validate([
            'pincode' => 'required|digits:6',
            'store_id' => 'required|integer',
            'max_days' => 'required|max:10|min:1|integer',
            'min_days' => 'required|max:10|min:1|integer',
            'pickup_time' => 'required|date_format:H:i',

        ]);
        Pincode::create($data);
        return redirect('/delivery/pincode')->with(['store_id'=>$data['store_id'],'success'=>'Pincode Added Successfully']);
    }

    public function delete_delivery($id){
        $store_id=StoreHasPincode::find($id)->store_id;
        StoreHasPincode::find($id)->delete();
        return redirect()->back()->with(['store_id'=>$store_id,'success'=>'Pincode history deleted']);
    }
}
