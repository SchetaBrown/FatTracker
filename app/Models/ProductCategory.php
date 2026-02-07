<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'category'
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
