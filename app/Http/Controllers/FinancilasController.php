<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\Visit;
use App\ExportImport;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinancilasController extends Controller
{

    // public function index(){
    //     //$visits = visit::where('visit_date',date('Y-m-d'))->where('status','>=',3)->get();
    //     $visits = visit::where('visit_date',date('Y-m-d'))->get();



    //     $total_today = $visits->sum('paid');//get_total_money_today_form_appointments();



    //     $imports_exports = ExportImport::whereDay('created_at',now()->day)->get();
        
    //     $total_exports = 0;
    //     $total_imports = 0;
    //     foreach ($imports_exports as $item) {
    //         if ($item->type == "exports") {
    //             $total_exports += $item->amount;
    //         }elseif($item->type == "imports"){
    //             $total_imports += $item->amount;
    //         }
            
    //     }

    //     return view('financilas.index',compact('visits','total_today','imports_exports','total_exports','total_imports'));
    // }


    
    public function index(){
        $clinics = Clinic::all();
        return view('financilas.new_index',compact('clinics'));
    }

    public function imports_exports(Request $request){
        //dd($request->all());

        //validte
        $request->validate([
            'details' => 'required',
        ]);
        if($request->has('exports') && $request->exports != "0" ){
            $request->validate([
                'exports' => 'required',
            ]);
            
            ExportImport::create([
                'type'   => 'exports',
                'amount' => $request->exports,
                'clinic_id' => $request->clinic_id,
                'details' => $request->details,
            ]);

        }elseif($request->has('imports') && $request->imports != "0" ){
            $request->validate([
                'imports' => 'required',
            ]);

            ExportImport::create([
                'type'   => 'imports',
                'amount' => $request->imports,
                'clinic_id' => $request->clinic_id,
                'details' => $request->details,
            ]);
        }


        //return back
        return redirect()->back()->with('success',__('site.added_successfully'));

    }
}
