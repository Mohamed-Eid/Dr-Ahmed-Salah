<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $guarded = [];

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}
