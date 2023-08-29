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
            $pincodes=Pincode::get();
            $store_id=$req->store_id;
            return DataTables::of($pincodes)
            ->editColumn('delivery_time',function($pincode) use ($store_id){
                $d='<form action="';
                $d .=url('delivery/update-delivery');
                $d .='" method="post">';
                $d .='<input type="hidden" name="_token" value="'.csrf_token().'">';
                $d .='<input type="hidden" name="store_id" value="'.$store_id.'">';
                $d .="<input type='hidden' name='pincode_id' value='".$pincode->id."'>".'<div class="input-group">';
               $d .= '<input type="text" class="form-control" name="min_day" value="';
               $d .=$pincode->getStoreDeliveryAttribute($store_id)?$pincode->getStoreDeliveryAttribute($store_id)->min_day:'';
               $d .='" required pattern="[0-9]*" title="Delivery Time should be as \'2\' days">';
               $d .= '<input type="text" class="form-control" name="max_day" value="';
               $d .=$pincode->getStoreDeliveryAttribute($store_id)?$pincode->getStoreDeliveryAttribute($store_id)->max_day:'';
               $d .='" required pattern="[0-9]*" title="Delivery Time should be as \'23\' days">';
               $d .= '<input type="time" class="form-control" name="shipment_pickup_time" value="';
               $d .=$pincode->getStoreDeliveryAttribute($store_id)?$pincode->getStoreDeliveryAttribute($store_id)->shipment_pickup_time:'';
               $d .='" required title="Delivery Time should be as H:i ">';
               $d .='<div class="input-group-append"><button class="btn  btn-light btn-square" type="submit"><i class="fa fa-check-circle-o  fa-2x text-success"></i></button><a class="btn btn-light btn-square" href="';
               $d .=$pincode->getStoreDeliveryAttribute($store_id)->id?route('company.delivery.del-delivery',$pincode->getStoreDeliveryAttribute($store_id)->id):'#';
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
        $res=StoreHasPincode::updateOrCreate(['store_id'=>$req->store_id,'pincode_id'=>$req->pincode_id],[
            'store_id'=>$req->store_id,
            'pincode_id'=>$req->pincode_id,
            'min_day'=>$req->min_day,
            'max_day'=>$req->max_day,
            'shipment_pickup_time'=>$req->shipment_pickup_time
        ]);
        if($res){
            Session::flash('success','Delivery Time Updated');
        }
        else
        {
            Session::flash('error','Delivery Not Updated');
        }
        return redirect()->back()->with('store_id',$req->store_id);
    }

    public function delete_delivery($id){
        $store_id=StoreHasPincode::find($id)->store_id;
        StoreHasPincode::find($id)->delete();
        return redirect()->back()->with(['store_id'=>$store_id,'success'=>'Pincode history deleted']);
    }
}