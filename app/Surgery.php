<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Surgery extends Model
{
    protected $guarded = [];

    public function procedures(){
        return $this->hasMany(Procedure::class);
    }

    public function patient_male_count(){
        
        return Patient::whereHas('procedures',function(Builder $query){
            $query->whereIn('id',$this->procedures->pluck('id'));
        })->where([
            'gender' => 1
        ])->count();
    }

    public function patient_female_count(){
        return Patient::whereHas('procedures',function(Builder $query){
            $query->whereIn('id',$this->procedures->pluck('id'));
        })->where([
            'gender' => 0
        ])->count();
    }

    public function procedures_total_fees(){
        $total = 0;
        foreach ($this->procedures as $procedure) {
            // dd($procedure->procedure_payment->procedure_fees);
            if($procedure->procedure_payment)
                $total += $procedure->procedure_payment->procedure_fees ;
        }
        return $total;
    }

    public function surgeries(){
        return $this->hasManyThrough(Surgery::class, Procedure::class);
    }

    public function procedures_hospital_fees(){
        $total = 0;
        foreach ($this->procedures as $procedure) {
            if($procedure->procedure_payment)
                $total += ($procedure->procedure_payment->hospital_cost + $procedure->procedure_payment->hospital_other_fees);
        }
        return $total;
    }
}
