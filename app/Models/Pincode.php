<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StoreHasPincode;
use Auth;
use Helper;
class Pincode extends Model
{
    use HasFactory;

    public function getStoreDeliveryAttribute($store_id){
       if($data=StoreHasPincode::where('store_id',$store_id)->where('pincode_id',$this->id)->first())
       {
        return $data;
       }
       $data= new \stdClass;
       $data->id='';
       $data->min_day='';
       $data->max_day='';
       $data->shipment_pickup_time='';
       return $data;
    }
}
