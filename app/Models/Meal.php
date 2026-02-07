<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = [
        'meal'
    ];

    public function userRecord()
    {
        return $this->hasMany(UserRecord::class);
    }
}
