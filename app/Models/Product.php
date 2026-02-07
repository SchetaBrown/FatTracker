<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'calories',
        'protein',
        'fat',
        'carbs',
        'product_category_id',
        'product_unit_id',
    ];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function productUnit()
    {
        return $this->belongsTo(ProductUnit::class);
    }

    public function userRecord()
    {
        return $this->hasMany(UserRecord::class);
    }
}
