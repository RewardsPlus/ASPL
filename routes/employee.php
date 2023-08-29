<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\employee\DashboardController;
use App\Http\Controllers\employee\AuthController;
use App\Http\Controllers\employee\AttendanceController;
use App\Http\Controllers\employee\LeaveController;
use App\Models\Attendance;

Route::get('company-dashboard',[DashboardController::class,'company_employee'])->name('company-dashboard');
Route::group(['prefix'=>'auth','as'=>'auth.'],function(){
    Route::get('logout',[AuthController::class, 'logout'])->name('logout');
});

Route::group(['prefix'=>'attendance','as'=>'attendance.'],function(){
    Route::get('index',[AttendanceController::class,'index'])->name('index');
    Route::get('clock-in',[AttendanceController::class,'clock_in'])->name('clock-in');
    Route::get('clock-out',[AttendanceController::class,'clock_out'])->name('clock-out');
    Route::get('employee-list',[AttendanceController::class,'employee_list'])->name('employee-list');
    Route::post('bulk',[AttendanceController::class,'bulk_attendance'])->name('bulk');
    Route::get('bulk-attendance-get',[AttendanceController::class,'bulk_attendance_get'])->name('bulk-attendance-get');
});
// Leave Route
Route::group(['prefix'=>'leave','as'=>'leave.'],function(){
    Route::get('index',[LeaveController::class,'index'])->name('index');
    Route::post('store',[LeaveController::class,'store'])->name('store');
});

// 