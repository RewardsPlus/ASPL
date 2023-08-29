<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Store extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded=[];
    public function company()
    {
       return $this->belongsTo(Company::class,'company_id');
    }
    public function detail()
    {
       return $this->hasOne(StoreDetail::class,'store_id','id');
    }

}
