<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $guarded = [];

    public function procedure_payments(){
        return $this->hasMany(ProcedurePayment::class);
    }
}
