<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLevel extends Model
{
    protected $fillable = [
        'level'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
