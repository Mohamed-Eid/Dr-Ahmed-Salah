<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\Drug;
use App\Hospital;
use App\NonSurgery;
use App\Patient;
use App\Surgery;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function surgeries(Request $request){
        // $surgeries = Surgery::all();
        
        $surgeries = Surgery::when($request->id , function ($q) use ($request){
            return $q->where('id',$request->id);
        })->latest()->get();//->paginate(10);
        
        return view('reports.surgeries',compact('surgeries'));
    }
    
    public function non_surgeries(Request $request){
        // $surgeries = Surgery::all();
        
        $surgeries = NonSurgery::when($request->id , function ($q) use ($request){
            return $q->where('id',$request->id);
        })->latest()->get();//->paginate(10);
        
        return view('reports.non_surgeries',compact('surgeries'));
    }


    public function clinics(Request $request){
        $clinics = Clinic::all();

        return view('reports.clinics',compact('clinics'));
    }

    public function surgeries_payment(Request $request){
        $surgeries = Surgery::when($request->id , function ($q) use ($request){
            return $q->where('id',$request->id);
        })->latest()->get();//->paginate(10);
        
        return view('reports.surgeries_payment',compact('surgeries'));
    }

    public function hospitals(Request $request){
        
        // $hospitals = Hospital::paginate(10);
        
        $hospitals = Hospital::when($request->id , function ($q) use ($request){
            return $q->where('id',$request->id);
        })->latest()->get();//->paginate(10);
        
        
        return view('reports.hospitals',compact('hospitals'));
    }

    public function patients(Request $request){
        // $patients = Patient::all();
        
        $patients = Patient::when($request->id , function ($q) use ($request){
            return $q->where('id',$request->id);
        })->latest()->get();//->paginate(10);
        
        return view('reports.patients',compact('patients'));
    }

    public function patient_cash(Patient $patient){
        return view('reports.patient.cash',compact('patient'));
    }

    
    public function patient_installmets(Patient $patient){
        return view('reports.patient.installment',compact('patient'));
    }

    public function drug_report(Request $request, Drug $drug){
        
        $in_procedures = $drug->in_procedures->when($request->from,function ($q) use ($request){
            return $q->where('created_at','>=',$request->from);
        })->when($request->to,function($q) use($request){
            return $q->where('created_at','<=',$request->to);
        });

        // dd($in_procedures);

        return view('reports.drug',compact('drug','in_procedures'));
    }
}
