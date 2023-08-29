<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;

class Company extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];
    public function company_detail()
    {
        return $this->hasOne(CompanyDetail::class,'company_id');
    }
    public function employeeable()
    {
        return $this->morphMany(Employee::class,'employeeable');

    }
    public function store()
    {
        return $this->hasMany(Store::class,'company_id');
    }
    public function rolecreated()
    {
        return $this->morphMany(Role::class,'createable');
    }
    public function employees()
    {
        return $this->morphMany(Employee::class,'employeeable');
    }
}
