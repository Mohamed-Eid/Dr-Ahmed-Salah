<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    // public function in_procedures()
    // {
    //     return $this->hasMany(InProcedure::class);
    // }

    public function in_procedures()
    {
    //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
        return $this->belongsToMany(
            InProcedure::class,
            'drugs_in_procedures',
            'drug_id',
            'in_procedure_id')->withPivot('amount', 'comment')->withTimestamps();
    }

    public function used(){
        $q = 0;
        foreach ($this->in_procedures as $in_procedure) {
            $q += $in_procedure->pivot->amount;
        }
        return $q;
    }

}
