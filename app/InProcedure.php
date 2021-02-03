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
}
