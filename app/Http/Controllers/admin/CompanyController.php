<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyCategory;
use App\Models\BusinessType;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Store;
use App\Models\CompanyDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use DB;
use Session;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=CompanyCategory::ParentCategories()->get();
        $businesstypes=BusinessType::get();
        $companies=Company::latest()->paginate(10);
        return view('company.list',compact('categories','businesstypes','companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
      $req->validate([
        'name'=>'required|string|max:255',
        'email'=>'required|unique:companies,email|email',
        'mobile'=>'required|unique:companies,mobile',
        'i_cat'=>'required|exists:company_categories,id',
        'i_subcat'=>'required|exists:company_categories,id',
        'business_type'=>'required|exists:business_types,id',
        'company_name'=>'required|string|max:255',
        'password'=>'required|min:8'
      ]);
      $data=Company::create([
        'name'=>$req->name,
        'email'=>$req->email,
        'mobile'=>$req->mobile,
        'password'=>Hash::make($req->password),
        'creatable_type'=>get_class(Auth::guard(Helper::getGuard())->user()),
        'creatable_id'=>Auth::guard(Helper::getGuard())->user()->id,
        'ownerable_type'=>get_class(Auth::guard(Helper::getGuard())->user()),
        'ownerable_id'=>Auth::guard(Helper::getGuard())->user()->id

      ]);

      if($data){
        $d=CompanyDetail::create(['company_id'=>$data->id,
        'company_name'=>$req->company_name??'',
        'company_category_id'=>$req->i_subcat??'',
        'business_type_id'=>$req->business_type??''
      ]);
      }
      if($d and $data){
        return redirect()->back()->with('toast_success','Company Register Successfully');
      }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories=CompanyCategory::ParentCategories()->get();
        $businesstypes=BusinessType::get();
        $company=Company::find($id);
        return view('company.edit-company',compact('categories','businesstypes','company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        $req->validate([
            'name'=>'required|string|max:255',
            'mobile'=>'required',
            'i_cat'=>'required|exists:company_categories,id',
            'i_subcat'=>'required|exists:company_categories,id',
            'business_type'=>'required|exists:business_types,id',
            'company_name'=>'required|string|max:255',
          ]);
          $data=Company::find($id);
          $data->update([
            'name'=>$req->name,
            'email'=>$req->email,
            'mobile'=>$req->mobile,
            'password'=>Hash::make($req->password),
            'creatable_type'=>get_class(Auth::guard(Helper::getGuard())->user()),
            'creatable_id'=>Auth::guard(Helper::getGuard())->user()->id,
            'ownerable_type'=>get_class(Auth::guard(Helper::getGuard())->user()),
            'ownerable_id'=>Auth::guard(Helper::getGuard())->user()->id
    
          ]);
    
          if($data){
            $d=CompanyDetail::where('company_id',$data->id)->update(['company_id'=>$data->id,
            'company_name'=>$req->company_name??'',
            'company_category_id'=>$req->i_subcat??'',
            'business_type_id'=>$req->business_type??''
          ]);
          }
          if($d and $data){
            return redirect()->back()->with('toast_success','Company updated Successfully');
          }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       if(Company::find($id)->delete()){
        return redirect()->back()->with('toast_success','Company Deleted Successfully');
       }
       return redirect()->back()->with('toast_erro','Company Not  Found');
    }

    public function get_company_subcategory(Request $req)
    {
        $req->validate([
            'category_id'=>'required|exists:company_categories,id',
            'reqtype'=>'required|in:op'
        ]);
        $categories=CompanyCategory::where('parent_id',$req->category_id)->get();
        $data='';
        if($req->reqtype=='op')
        {
            $data .="<option value='' selected disabled>Select Option</option>";
            foreach($categories as $cat){
                $data .="<option value={$cat->id}>".$cat->name."</option>";
            }
        }
        else
        {
            $data=$categories;
        }
        return $data;
    }

    // Fetch from old database
    public function fetch_old_companies()
    {
        try{
        $olddatas=DB::connection('oldmysql')->table('company')->get();
        //return $olddatas;
        foreach($olddatas as $dt){
            $data=Company::updateOrCreate(['email'=>$dt->email],[
                'name'=>$dt->name,
                'email'=>$dt->email,
                'mobile'=>$dt->mobile,
                'password'=>Hash::make($dt->password),
                'creatable_type'=>get_class(Auth::guard(Helper::getGuard())->user()),
                'creatable_id'=>Auth::guard(Helper::getGuard())->user()->id,
                'ownerable_type'=>get_class(Auth::guard(Helper::getGuard())->user()),
                'ownerable_id'=>Auth::guard(Helper::getGuard())->user()->id

              ]);
              if($data){
                $d=CompanyDetail::updateOrCreate(['company_id'=>$data->id],[
                'company_id'=>$data->id,
                'company_name'=>$dt->company_name??'',
                'company_category_id'=>$dt->i_subcat??$dt->i_cat,
                'business_type_id'=>$dt->business_type??1
              ]);
              }
        }
    }
    catch(Exception $ex){
        Helper::handleError($ex->getMessage());
        return redirect()->back()->with('toast_error','Something Went Wrong');
    }
    return redirect()->back()->with('toast_success','Data Import Successfully');
    }

    public function company_employee()
    {
        $employees=Employee::latest()->paginate(10);
        $store=Store::all();
        $data = CompanyDetail::get(['company_name','id']);
        return view('employee.list',compact('employees','data','store'));
    }
    public function fetchstore($id)
    {
        $user = Company::with('store')->find($id);
        // dd($user->store);
        $html ='<option selected disabled hidden>Select your Store</option>';
        foreach($user->store as $dt){
            $html.="<option value=".$dt->id.">".$dt->name."</option>";
        }
        return $html;
    }
    
    public function fetch_old_employees()
    {
       $employees=$olddatas=DB::connection('oldmysql')->table('employee')->get();
      foreach($employees as $emp){
        $oldcmp=DB::connection('oldmysql')->table('company')->find($emp->company_id);
        $oldstore=DB::connection('oldmysql')->table('store')->find($emp->store_id);
        $newcmp=Company::where('email',$oldcmp->email)->first();
        $newstore=Store::where('email',$oldstore->email)->first();
        $oldstcmp=[];
        if($newcmp->email and $newstore->email)
        {
            $data=Auth::guard(Helper::getGuard())->user()->employees()->updateOrCreate(['email'=>$emp->email],[
                'name'=>$emp->name??'',
                'email'=>$emp->email??'',
                'mobile'=>$emp->contact??'', 
                'password'=>Hash::make($emp->password??12346578),
                'employeeable_type'=>get_class(new Company()),
                'employeeable_id'=>$newcmp->id,
                'uniqid'=>$emp->uniqid??'',
                'company_id'=>$newcmp->id??'',
                'store_id'=>$newstore->id??'',
            ]);
        }
        else
        {
            $oldstcmp[]=[$oldcmp->email=>$oldstore->email];
        }
       
      }
      Session::flash('warning',json_encode($oldstcmp));
      return redirect()->back()->with('toast_success','Employee Fetch successfully');
    }
}
