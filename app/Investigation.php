<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    protected $guarded = [];

    public function investigation_files(){
        return $this->hasMany(InvestigationFile::class);
    }

    public function get_setting_item(){
        $patient_complaints = get_setting_by_key('investigations')->details;
        $patient_complaints = json_decode($patient_complaints);

        foreach ($patient_complaints->items as  $item) {
            if($item->id == $this->key)
                return $item ;
        } ;
    }
}
