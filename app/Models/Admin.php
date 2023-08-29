<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public function ownerable(): MorphTo
    {
        return $this->morphTo();
    }
    public function createable(): MorphTo
    {
        return $this->morphTo();
    }

    public function roles(): MorphMany
    {
        return $this->morphMany(Role::class,'creatable');
    }
    public function stores()
    {
       return $this->morphMany(Store::class,'creatable');
    }
    public function employees()
    {
        return $this->morphMany(Employee::class,'creatable');
    }
}
