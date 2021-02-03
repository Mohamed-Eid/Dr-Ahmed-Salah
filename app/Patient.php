<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = [];
    protected $appends = ['image_path'];

    public $casts = [
        'chronic_diseases' => 'array'
    ];

    public function visits(){
        return $this->hasMany(Visit::class);
    }

    public function patient_complaints(){
        return $this->hasMany(PatientComplaint::class);
    }

    public function investigations(){
        return $this->hasMany(Investigation::class);
    }

    public function patient_images(){
        return $this->hasMany(PatientImage::class);
    }

    public function cash_payments(){
        return $this->hasMany(CashPayment::class);
    }

    public function procedure_payments(){
        return $this->hasMany(ProcedurePayment::class);
    }
    

    public function procedures(){
        return $this->hasMany(Procedure::class);
    }

    public function patient_examinations()
    {
        return $this->hasMany(PatientExamination::class);
    }

    public function patient_diagnoses()
    {
        return $this->hasMany(PatientDiagnosis::class);
    }

    public function patient_plans()
    {
        return $this->hasMany(PatientPlan::class);
    }

    public function doctor_info(){
        return $this->hasOne(DoctorInfo::class);
    }

    public function getImagePathAttribute(){
        return asset('uploads/users_images/'.$this->image);
    }

    public function chronic_diseases_data(){
        $data = [];
        $cd = $this->chronic_diseases ?? [];
        foreach ( $cd as $key => $value) {
            $data[] = $value; 
        }
        return implode(', ',$data) ;
    }
    public function chronic_diseases_array(){
        $data = [];
        // dd($this->chronic_diseases);
        if($this->chronic_diseases){
            foreach ($this->chronic_diseases as $key => $value) {
                $data[] = $key; 
            }            
        }

        return $data;
    }
}
