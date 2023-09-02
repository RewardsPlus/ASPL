<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AuthController as AdminAuth;
use App\Http\Controllers\employee\AuthController as EmployeeAuth;
use App\Http\Controllers\store\AuthController as StoreAuth;
use App\Http\Controllers\company\AuthController as CompanyAuth;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\TestController;
use Carbon\Carbon;
use Vormkracht10\Analytics\Facades\Analytics;
use Vormkracht10\Analytics\Period;
use App\Http\Controllers\QRCodeController;

// Route::get('/', function () {
//     $startDate = Carbon::now()->subYear();
//     $endDate = Carbon::now();

//     dd($analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7)));

//     });
    Route::view('qr-code', 'qr-code');
    Route::group(['as'=>'admin.','domain'=>'admin.'.env('APP_URL')],function(){
        Route::get('/',function(){
            return redirect()->route('admin.auth.login-view');
        });
    });
    Route::group(['as'=>'company.','domain'=>'company.'.env('APP_URL')],function(){
        Route::get('/',function(){
            return redirect()->route('company.auth.login-view');
        });
    });
    Route::group(['as'=>'employee.','domain'=>'employee.'.env('APP_URL')],function(){
        Route::get('/',function(){
            return redirect()->route('employee.auth.login-view');
        });
    });
    Route::group(['prefix'=>'auth','as'=>'admin.auth.','domain'=>'admin.'. env('APP_URL')],function(){

        Route::get('login',[AdminAuth::class,'login_view'])->name('login-view');
        Route::post('login',[AdminAuth::class,'login'])->name('login');
    });
    Route::group(['prefix'=>'auth','as'=>'employee.auth.','domain'=>'employee.'. env('APP_URL')],function(){
        Route::get('/',function(){return redirect()->route('employee.auth.login');});
        Route::get('login',[EmployeeAuth::class,'login_view'])->name('login-view');
        Route::post('login',[EmployeeAuth::class,'login'])->name('login');
    });
    Route::group(['prefix'=>'auth','as'=>'store.auth.','domain'=>'store.'. env('APP_URL')],function(){
        Route::get('/',function(){return redirect()->route('store.auth.login');});
        Route::get('login',[StoreAuth::class,'login_view'])->name('login-view');
        Route::post('login',[StoreAuth::class,'login'])->name('login');
    });
    Route::group(['prefix'=>'auth','as'=>'company.auth.','domain'=>'company.'. env('APP_URL')],function(){
        Route::get('/',function(){return redirect()->route('company.auth.login');});
        Route::get('login',[CompanyAuth::class,'login_view'])->name('login-view');
        Route::post('login',[CompanyAuth::class,'login'])->name('login');
    });

    if ( env('APP_URL') == 'http://localhost:8000') {
        Route::get('/',function(){return redirect()->route('company.auth.login');});

        Route::group(['prefix'=>'auth','as'=>'company.auth.'],function(){
            Route::get('login',[CompanyAuth::class,'login_view'])->name('login');
            Route::post('login',[CompanyAuth::class,'login'])->name('login');
        });
    }
    Route::group(['prefix'=>'general','as'=>'general.'],function(){
        Route::post('get-state',[GeneralController::class,'get_state_by_country'])->name('get-state');
        Route::post('get-city',[GeneralController::class,'get_state_by_city'])->name('get-city');
        Route::post('get-store',[GeneralController::class,'get_store_by_company'])->name('get-store');
    });

    Route::get('php-info',function(){
        return view('info');
    });

    // Route::get('analytics',[TestController::class,'see']);

    Route::get('show-data/{qRCode}',[ QRCodeController::class,'showData']);

    Route::get('download-qr-code/{qRCode}',[QRCodeController::class,'download'])->name('downloadqr');

    Route::resource('qrcodes', QRCodeController::class)->parameters(['qrcodes'=>'qRCode']);
