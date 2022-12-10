<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Encore\Admin\Auth\Database\Administrator;

class Product extends Model
{
    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'category_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(ProductSubCategory::class,'subcategory_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(Administrator::class,'created_by', 'id');
    }
    public function updator()
    {
        return $this->belongsTo(Administrator::class,'updated_by', 'id');
    }
}
