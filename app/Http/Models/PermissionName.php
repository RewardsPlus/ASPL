<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionName extends Model
{
    use HasFactory;
    public static $admin = 'admin';
    public static $company = 'company';
    public static $store = 'store';
    public static $employee = 'employee';
    public static $sanctum='sanctum';

    protected $guarded=[];

    public function permissions()
    {
       return $this->hasMany(Permission::class,'permission_name_id');
    }
}
