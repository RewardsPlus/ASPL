<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CompanyCategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=[];
    public function children()
  {
    return $this->hasMany(CompanyCategory::class, 'parent_id');
  }
  public function scopeParentCategories()
  {
    return $this->where('parent_id',NULL)->orWhere('parent_id','')->orWhere('parent_id',0);
  }
}
