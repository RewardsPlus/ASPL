<?php

namespace App\Http\Controllers\api;


use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pincode;
use App\Models\Store;
use App\Models\StoreHasPincode;
use Exception;

class PincodeDeliveryController extends Controller
{
    public function get_pincode_delivery(Request $req){
        $req->validate([
            'pincode'=>'required|exists:pincodes,pincode',
            'store_email'=>'required|exists:stores,email',
            'current_time'=>'required|date_format:H:i'
        ]);
        try{
            $store_id=Store::where('email',$req->store_email)->first()->id;
            $pincode_id=Pincode::where('pincode',$req->pincode)->first()->id;
        if($delivery=StoreHasPincode::where('store_id',$store_id)->where('pincode_id',$pincode_id)->first()){
            $res=[
                'data'=>$delivery->getDayDurationAttribute($req->current_time),
                'message'=>'Delivery found',
                'is_success'=>true,
                'error'=>NULL
            ];
        }
        else
        {
            $res=[
                'data'=>NULL,
                'message'=>'Delivery Not found',
                'is_success'=>true,
                'error'=>NULL
            ];
        }
    }
    catch(Exception $ex){
        $res=[
            'data'=>NULL,
            'message'=>'Something went wrong',
            'is_success'=>false,
            'error'=>[
                'code'=>500,
                'message'=>$ex->getMessage()
            ]
        ];
    }
        return response()->json($res);
    }
}
