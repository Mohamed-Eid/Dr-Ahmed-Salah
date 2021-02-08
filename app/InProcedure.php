<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InProcedure extends Model
{
    protected $guarded = [];

    public function visit(){
        return $this->belongsTo(Visit::class);
    } 
    
    public function patient(){
        return $this->belongsTo(Patient::class);
    } 

    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }

    public function non_surgery(){
        return $this->belongsTo(NonSurgery::class);
    }

    public function drugs()
    {
    //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
        return $this->belongsToMany(
            Drug::class,
            'drugs_in_procedures',
            'in_procedure_id',
            'drug_id')->withPivot('amount', 'comment')->withTimestamps();
    }
}
