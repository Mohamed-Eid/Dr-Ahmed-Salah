<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class NonSurgery extends Model
{
    protected $fillable = ['name'];

    public function in_procedures(){
        return $this->hasMany(InProcedure::class);
    }

    public function patient_male_count(){
        
        return Patient::whereHas('in_procedures',function(Builder $query){
            $query->whereIn('id',$this->in_procedures()->pluck('id'));
        })->where([
            'gender' => 1
        ])->count();
    }

    public function patient_female_count(){
        return Patient::whereHas('in_procedures',function(Builder $query){
            $query->whereIn('id',$this->in_procedures()->pluck('id'));
        })->where([
            'gender' => 0
        ])->count();
    }
}
