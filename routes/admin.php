<?php

use App\Http\Controllers\admin\AttendanceController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\CompanyController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\RolePermissionController;
use App\Http\Controllers\admin\StoreController;
use App\Http\Controllers\admin\EmployeeController;
use App\Models\EmployeeDetail;
// Auth Route
use Illuminate\Support\Facades\Route;

Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
Route::group(['prefix' => 'role-permission', 'as' => 'role-permission.'], function () {
    Route::resource('role', RoleController::class)->name('role', '');
    Route::resource('permission', PermissionController::class)->name('permission', '');
    Route::get('role-has-permission', [RolePermissionController::class, 'role_permission']);
    Route::post('fetch-permissions', [RolePermissionController::class, 'fetch_permission']);
    Route::post('assign-permission', [RolePermissionController::class, 'assign_permission']);
    Route::get('fetch-role', [RoleController::class, 'fetch_role'])->name('fetch-role');
    Route::get('/isactive/{id}', [RoleController::class, 'is_active'])->name('active-role');
    Route::get('customer-has-permission', [RoleController::class, 'fetch_role']);
    Route::post('assign-roles',[RolePermissionController::class, 'assign_permission'])->name('assign-roles');
});
Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

Route::group(['prefix'=>'company','as'=>'company.'],function(){
Route::post('subcategory',[CompanyController::class,'get_company_subcategory'])->name('subcategory');
Route::get('old-companies',[CompanyController::class,'fetch_old_companies'])->name('fetch-old-companies');
Route::get('employee',[CompanyController::class,'company_employee'])->name('employee');
Route::get('old-employees',[CompanyController::class,'fetch_old_employees'])->name('fetch-old-employees');
Route::get('company-employee-attendance',[AttendanceController::class,'company_employee_attendance'])->name('employee-attendance');
Route::get('company-bulk-attendance-get',[AttendanceController::class,'company_bulk_attendance_get'])->name('bulk-attendance-get');
Route::post('company-bulk-attendance',[AttendanceController::class,'company_bulk_attendance'])->name('bulk-attendance');
});
Route::resource('company',CompanyController::class)->name('company','');
Route::get('store/old-stores',[StoreController::class,'fetch_old_stores'])->name('store.fetch-old-stores');
Route::get('api/fetch-company/{id?}',[CompanyController::class,'fetchstore']);
Route::get('api/fetch-store/{id?}',[EmployeeController::class,'fetchcompany']);
Route::resource('store',StoreController::class)->name('store','');
Route::resource('employee',EmployeeController::class)->name('employee','');

