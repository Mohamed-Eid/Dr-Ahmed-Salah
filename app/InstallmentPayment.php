<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstallmentPayment extends Model
{
    protected $guarded = [];

    public function months(){
        return $this->hasMany(Month::class);
    }
}
