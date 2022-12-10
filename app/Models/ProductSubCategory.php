<?php

namespace App\Models;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSubCategory extends Model
{
    protected $table = 'product_subcategories';

    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'category_id', 'id');
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
