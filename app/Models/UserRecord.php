<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRecord extends Model
{
    protected $fillable = [
        'quantity',
        'date',
        'user_id',
        'meal_id',
        'product_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
