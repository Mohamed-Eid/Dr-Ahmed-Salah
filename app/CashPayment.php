<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashPayment extends Model
{
    protected $guarded = [];
    
    public function procedure_payment(){
        return $this->belongsTo(ProcedurePayment::class);
    }
}
