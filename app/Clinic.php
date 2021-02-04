<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $guarded = [];

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function clinic_fees(){
        return $this->hasOne(ClinicFee::class);
    }

    public function export_imports(){
        return $this->hasMany(ExportImport::class);
    }
    
    public function export_imports_today(){
        return $this->export_imports()->whereDate('created_at',date('Y-m-d'))->get();
    }

    public function total_exports_today(){
        return $this->export_imports()->whereDate('created_at',date('Y-m-d'))->where('type','exports')->sum('amount');
    }

    public function total_imports_today(){
        return $this->export_imports()->whereDate('created_at',date('Y-m-d'))->where('type','imports')->sum('amount');
    }

    public function total_today(){
        return $this->visits->where('visit_date',date('Y-m-d'))->sum('paid');
    }

    public function today_visits(){
        return $this->visits->where('visit_date',date('Y-m-d'));
    }
}
