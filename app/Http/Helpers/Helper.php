<?php

namespace App\Helpers;

use App\Models\City;
use App\Models\Company;
use App\Models\CompanyCategory;
use App\Models\Country;
use App\Models\Currency;
use App\Models\customer\Checkpoint;
use App\Models\customer\Customer;
use App\Models\customer\Property;
use App\Models\customer\Route;
use App\Models\PermissionName;
use App\Models\ProjectError;
use App\Models\SecurityGuard;
use App\Models\Shift;
use App\Models\State;
use App\Models\Store;
use App\Models\TimeZone;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Helper
{

    public static function getCountries()
    {
        return $countries = Country::get();
    }

    public static function getStateByCountry($id)
    {
        try {
            $states = State::active()->where('country_id', $id)->get();
            return $states;
        }
        catch(Exception $ex){
            return response()->json(['message' => $ex->getMessage()],501);
        }
    }
    public static function getCitiesByState($id)
    {
        try {
            $cities = City::active()->where('state_id', $id)->get();
            return $cities;
        }
        catch(Exception $ex){
            return response()->json(['message' => $ex->getMessage()],501);
        }
    }

    public static function getUserId()
    {
        $logged_in_user_id = Auth::guard(Helper::getGuard())->user()->id;
        return $logged_in_user_id;
    }

    public static function getUser()
    {
       if(Auth::guard(Helper::getGuard()??'web')->user()){
        return Auth::guard(Helper::getGuard()??'web')->user();
       }
       else if(Auth::guard('sanctum')->user())
       {
        return Auth::guard('sanctum')->user();
       }
       return false;
    }
    public static function getTimeZone()
    {
        return $timezones = TimeZone::active()->get();
    }

    public static function getCurrencies()
    {
        return $currencies = Currency::get();
    }

    public static function handleError($msg)
    {
        $url=URL::current();
        ProjectError::create(['url'=>$url,'message'=>$msg->getMessage()]);
        Session::flash('error','Server Error ');
    }

    public static function getOwner(){
        if(Auth::guard(PermissionName::$customer)->check()){
            if(Auth::guard(PermissionName::$customer)->user()->type==Customer::$owner){
                return Helper::getUserId();
            }
            else if(Auth::guard(PermissionName::$customer)->user()->type==Customer::$employee)
            {
                return Auth::guard(PermissionName::$customer)->user()->owner_id;
            }
            else if(Auth::guard('sanctum')->check()){
                Auth::guard('sanctum')->user()->owner_id;
            }
        }
    }

    public static function getGuard()
    {
        if(Auth::guard(PermissionName::$admin)->check())
        {
            return 'admin';
        }
        else if(Auth::guard(PermissionName::$company)->check()){
            return 'company';
        }
        else if(Auth::guard(PermissionName::$store)->check()){
            return 'store';
        }
        else if(Auth::guard(PermissionName::$employee)->check()){
            return 'employee';
        }
        else if(Auth::guard(PermissionName::$sanctum)->check()){
            return 'sanctum';
        }
    }


    public function sendError($message,$errors=[],$code=401)
    {
        $response = ['success' => false, 'message' => $message];
        if(!empty($errors)){
            $response['data'] = $errors;
        }
        throw new HttpResponseException(response()->json($response, $code));
    }



    public static function roleName($name)
    {
         $role=explode('_',$name);
         return $role[1];
    }


    public static function saveUtc($date)
    {
        return Carbon::createFromFormat('Y-m-d h:i', $date)->timezone('UTC');
    }
    public static function saveUtcTime($time)
    {
        return Carbon::createFromFormat('h:i', $time)->timezone('UTC');
    }
    public static function getLocalTime($date)
    {
        try{
        return Carbon::createFromFormat('d-m-Y h:i', $date)->timezone(Helper::getUser()->timezone->timezone)->format('d-m-Y h:i');
        }
        catch(Exception $ex){
            Helper::handleError($ex);
            return 'Date-Time Error';
        }
    }

    public static function getLocalTimeOnly($time)
    {
        try{
        return Carbon::createFromFormat('H:i:s', $time)->timezone(Helper::getUser()->timezone->timezone)->format('h:i a');
        }
        catch(Exception $ex){
            Helper::handleError($ex);
            return 'Date-Time Error';
        }
    }
 
    public static function getSubcategoriesByCategory($id)
    {
       return CompanyCategory::find($id)->children;
    }

    public static function Image($path,UploadedFile $file,$pre=null)
    {
        try{
    if($file->getSize()!=null){
        $filename=($pre?$pre.'-':'').time().'-'.rand(00,99999).'.'.$file->extension();
        $path=$file->storeAs($path,$filename,'public');
        return $path;
    }
    else
    {
      return '';
    }
    }
    catch(Exception $ex){
        Helper::handleError($ex);
        return '';
    }
    }

   public static function getStoresByCompany($id,$store_id=null){
    $stores=Store::where('company_id',$id)->get();
    if($store_id){
        $op ='<option value="'.$store_id.'" selected hidden >'.Store::find($store_id)->name.'</option>';
    }
    else{
      $op='<option value="">-- select store --</option>';
    }
      foreach($stores as $st){
        $op .='<option value="'.$st->id.'">'.$st->name.' (<b>'.$st->detail->code.'</b>)'.'</option>';
      }
      return $op;
   }

}
