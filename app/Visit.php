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
    

    public function type(){
        return [
            "1" => __('site.visit'),
            "2" => __('site.re_visit'),
            "3" => __('site.consultation'),
            "4" => __('site.free_consultation'),
        ][$this->type];
    }

    public function type_cost(){
        return [
            "1" => $this->clinic->clinic_fees->visit_cost,
            "2" => $this->clinic->clinic_fees->re_visit_cost,
            "3" => $this->clinic->clinic_fees->consultation_cost,
            "4" => $this->clinic->clinic_fees->free_consultation_cost,
        ][$this->type];
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
