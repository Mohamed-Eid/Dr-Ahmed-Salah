<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientPlan extends Model
{
    protected $guarded = [];

    public function get_setting_item(){
        $patient_complaints = get_setting_by_key('plan_items')->details;
        $patient_complaints = json_decode($patient_complaints);

        foreach ($patient_complaints->items as  $item) {
            if($item->id == $this->key)
                return $item ;
        } ;
    }
}
