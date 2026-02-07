<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLevel extends Model
{
    protected $fillable = [
        'level',
        'description',
        'multiplier',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
