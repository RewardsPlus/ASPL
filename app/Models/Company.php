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

    public function canManageBinshopsBlogPosts()
    {
        // Enter the logic needed for your app.
        // Maybe you can just hardcode in a user id that you
        //   know is always an admin ID?

        if (true){

           // return true so this user CAN edit/post/delete
           // blog posts (and post any HTML/JS)

           return true;
        }

        // otherwise return false, so they have no access
        // to the admin panel (but can still view posts)

        return false;
    }
}
