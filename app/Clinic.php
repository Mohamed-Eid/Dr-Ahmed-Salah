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

    public function clinic_fees(){
        return $this->hasOne(ClinicFee::class);
    }
}
