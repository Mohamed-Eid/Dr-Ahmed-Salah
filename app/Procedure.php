<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    protected $guarded = [];

    
    public function surgery(){
        return $this->belongsTo(Surgery::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function procedure_payment(){
        return $this->hasOne(ProcedurePayment::class);
    }

    public function procedure_anesthesias(){
        return $this->hasMany(ProcedureAnesthesia::class);
    }

    public function procedure_assistants(){
        return $this->hasMany(ProcedureAssistant::class);
    }

    public function procedure_surgents(){
        return $this->hasMany(ProcedureSurgent::class);
    }
}
