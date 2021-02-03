<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $guarded = [];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function visit_files(){
        return $this->hasMany(VisitFile::class);
    }

    public function visit_detail(){
        return $this->hasOne(VisitDetail::class);
    }

    public function clinic(){
        return $this->belongsTo(Clinic::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public static function boot()
    {
        // add this
        parent::boot();
    
        static::saving(function ($formRow) {
    
                $formRow->user_id = auth()->user()->id;         
    
        });
    }
    
}
