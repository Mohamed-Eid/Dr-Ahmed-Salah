<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorInfo extends Model
{
    protected $guarded = [];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
