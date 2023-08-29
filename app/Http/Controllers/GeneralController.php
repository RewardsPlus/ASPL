<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use App\Models\Store;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function get_state_by_country(Request $req)
    {
      $states=State::where('country_id',$req->country_id)->get();
      $op='';
      foreach($states as $st){
        $op .='<option value="'.$st->id.'">'.$st->name.'</option>';
      }
      return $op;
    }

    public function get_state_by_city(Request $req)
    {
        $cities=City::where('state_id',$req->state_id)->get();
      $op='';
      foreach($cities as $st){
        $op .='<option value="'.$st->id.'">'.$st->name.'</option>';
      }
      return $op;
    }

    public function get_store_by_company(Request $req)
    {
      $stores=Store::where('company_id',$req->company_id)->get();
      $op='<option value="">-- select store --</option>';
      foreach($stores as $st){
        $op .='<option value="'.$st->id.'">'.$st->name.' (<b>'.$st->detail->code.'</b>)'.'</option>';
      }
      return $op;
    }
}
