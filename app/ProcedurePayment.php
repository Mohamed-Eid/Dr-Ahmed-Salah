<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcedurePayment extends Model
{
    protected $guarded = [];

    public function cash_payment(){
        return $this->hasOne(CashPayment::class);
    }

    public function procedure(){
        return $this->belongsTo(Procedure::class);
    }


    public function surgeries(){
        return $this->belongsTo(Surgery::class);
    }


    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function hospital(){
        return $this->belongsTo(Hospital::class);
    }
    
    public function installment_payment(){
        return $this->hasOne(InstallmentPayment::class);
    }

    public function remainig(){
        if($this->payment_method == 'cash'){
            return $this->procedure_fees - ($this->pre_paid_amount + $this->cash_payment->paid) ;
        }else{
            return $this->procedure_fees - ($this->pre_paid_amount + $this->installment_payment->months->sum('paid'));
        }
    }
}
