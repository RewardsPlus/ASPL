<?php

use App\Http\Controllers\company\RoleController;
use App\Http\Controllers\company\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\company\AttendanceController;
use App\Http\Controllers\company\AuthController;
use App\Http\Controllers\company\EmployeeController;
use App\Http\Controllers\company\LeaveController;
use App\Http\Controllers\company\PermissionController;
use App\Http\Controllers\company\RolePermissionController;
use App\Http\Controllers\company\PincodeController;
Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
Route::get('logout',[AuthController::class, 'logout'])->name('auth.logout');
Route::name('attendance.')->group(function(){
    Route::get('attendance/index',[AttendanceController::class,'index'])->name('index');
    Route::post('attendance/clock-in',[AttendanceController::class,'clock_in'])->name('clock-in');
    Route::get('bulk-attendance-get',[AttendanceController::class,'bulk_attendance_get'])->name('bulk-attendance-get');
});
Route::name('employee.')->group(function(){
    Route::get('leave-application',[LeaveController::class,'leave_application'])->name('leave.application');
    Route::post('leave-status',[LeaveController::class,'leave_status'])->name('leave.status');
    Route::post('change-password',[EmployeeController::class,'change_password'])->name('change-password');
});

//Employee Routes
Route::resource('employee',EmployeeController::class)->name('employee','');

// Role Permission
Route::group(['prefix' => 'role-permission', 'as' => 'role-permission.'], function () {
    Route::resource('role', RoleController::class)->name('role', '');
    Route::resource('permission', PermissionController::class)->name('permission', '');
    Route::get('role-has-permission', [RolePermissionController::class, 'role_permission'])->name('role-has-permission');
    Route::post('fetch-permissions', [RolePermissionController::class, 'fetch_permission'])->name('fetch-permissions');
    Route::post('assign-permission', [RolePermissionController::class, 'assign_permission'])->name('assign-permission');
    Route::get('fetch-role', [RoleController::class, 'fetch_role'])->name('fetch-role');
    Route::post('assign-roles', [RolePermissionController::class, 'assign_roles'])->name('assign-roles');
    Route::get('revoke-role/{eid}/{role}',[RolePermissionController::class,'revoke_role'])->name('revoke-role');
    Route::get('/isactive/{id}', [RoleController::class, 'is_active'])->name('active-role');
    Route::get('customer-has-permission', [RoleController::class, 'fetch_role']);
});


// sales Employee
Route::get('fetch-sales-employee',[EmployeeController::class,'fetch_sales_employee'])->name('fetch-sales-employee');
Route::get('fetch-old-employees',[EmployeeController::class,'fetch_old_employees'])->name('company.fetch-old-emp');
Route::get('employee-login-status/{eid}/{status}',[EmployeeController::class,'employee_login_status'])->name('employee.login-status');

// Pincode Delivery
Route::group(['prefix'=>'delivery','as'=>'delivery.'],function(){
    Route::get('pincode',[PincodeController::class,'view_pincode'])->name('pincode');
    Route::get('pincode/new',[PincodeController::class,'new_pincode'])->name('pincode-new');
    Route::post('pincode/save-new-pincode',[PincodeController::class,'save_new_pincode'])->name('save-pincode-new');
    Route::post('update-delivery',[PincodeController::class,'update_delivery'])->name('update-delivery');
    Route::post('update-delivery',[PincodeController::class,'update_delivery'])->name('update-delivery');
    Route::get('delete-delivery/{id}',[PincodeController::class,'delete_delivery'])->name('del-delivery');
});
