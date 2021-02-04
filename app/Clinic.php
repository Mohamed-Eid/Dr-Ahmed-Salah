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
    
    public function total_visits_by_date($date){
        return $this->visits->where('visit_date',$date);
    }

    public function total_income_by_date($date){
        return $this->visits->where('visit_date',$date)->sum('paid');
    }

    public function export_imports_by_date($date){
        return $this->export_imports()->whereDate('created_at',$date)->get();
    }

    public function total_exports__by_date($date){
        return $this->export_imports()->whereDate('created_at',$date)->where('type','exports')->sum('amount');
    }

    public function total_imports_by_date($date){
        return $this->export_imports()->whereDate('created_at',$date)->where('type','imports')->sum('amount');
    }


    public function total_visits_in($from , $to){
        return $this->visits->where('visit_date','>=',$from )->where('visit_date','<=',$to);
    }

    public function total_income_in($from , $to){
        return $this->visits->where('visit_date','>=',$from )->where('visit_date','<=',$to)->sum('paid');
    }

    public function export_imports_in($from , $to){
        return $this->export_imports()->whereDate('created_at','>=',$from )->whereDate('created_at','<=',$to )->get();
    }

    public function total_exports_in($from , $to){
        return $this->export_imports()->whereDate('created_at','>=',$from )
                ->whereDate('created_at','<=',$to )
                ->where('type','exports')->sum('amount');
    }

    public function total_imports_in($from , $to){
        return $this->export_imports()
            ->whereDate('created_at','>=',$from )
            ->whereDate('created_at','<=',$to )
            ->where('type','imports')->sum('amount');
    }


}
