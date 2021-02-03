<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientComplaint extends Model
{
    protected $guarded = [];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function get_setting_item(){
        $patient_complaints = get_setting_by_key('patient_complaints')->details;
        $patient_complaints = json_decode($patient_complaints);

        foreach ($patient_complaints->items as  $item) {
            if($item->id == $this->key)
                return $item ;
        } ;
        return null;
    }
}
