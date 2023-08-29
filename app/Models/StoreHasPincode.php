<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use carbon\Carbon;
class StoreHasPincode extends Model
{
    use HasFactory;

   protected $guarded=[];

   public function getDayDurationAttribute($current_time){
    $currentTime = Carbon::createFromTimeString($current_time);
    $shipmentTime=Carbon::createFromTimeString($this->shipment_pickup_time);
    if($currentTime->lt($shipmentTime)){
        $diff = $shipmentTime->diff($currentTime); 
        $data=[
            'from'=>Carbon::now()->addDays($this->min_day)->format('d-M-Y'),
            'to'=>Carbon::now()->addDays($this->max_day)->format('d-M-Y'),
            'shipment_before'=>$diff->h.' hours '.$diff->i.' minutes',
        ];
    }
    else
    {
        
        $diff = $currentTime->diff($shipmentTime); 
        $data=[
            
            'from'=>Carbon::now()->addDays($this->min_day+1)->format('d-M-Y'),
            'to'=>Carbon::now()->addDays($this->max_day+1)->format('d-M-Y'),
            'shipment_before'=>'Tomorrow '.$shipmentTime->format('H:i'),
        ];
    }
    return $data;
   }
}
