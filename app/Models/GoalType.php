<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoalType extends Model
{
    protected $fillable = [
        'type'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
