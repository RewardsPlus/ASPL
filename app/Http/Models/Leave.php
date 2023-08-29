<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    public static $pending='pending';
    public static $approved='approved';
    public static $rejected='rejected';
    protected $guarded=[];
    public function leaveable()
    {
        return $this->morphTo();
    }
}
