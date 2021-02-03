<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicFee extends Model
{
    protected $guarded = [];

    public function clinic(){
        return $this->belongsTo(Clinic::class);
    }
}
