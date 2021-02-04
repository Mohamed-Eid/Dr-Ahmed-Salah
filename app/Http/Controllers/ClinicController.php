<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\ExportImport;
use App\Http\Requests\CreateClinicRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinics = Clinic::all();//paginate(10);
        return view('clinics.index',compact('clinics'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateClinicRequest $request)
    {
        $clinic = Clinic::create(['name' =>$request->name]);

        $clinic->clinic_fees()->create([
            'visit_cost' => $request->visit_cost,
            're_visit_cost' => $request->re_visit_cost,
            'consultation_cost' => $request->consultation_cost,
        ]);

        Alert::success('Clinic Saved Succesfully', '');
        return redirect()->back();
    }

    public function show(Request $request, Clinic $clinic)
    {

        $startDate = new Carbon(); //returns current day
        $firstDay = $startDate->firstOfMonth()->format('Y-m-d');
        
        $endDate = new Carbon();
        $endDay = $endDate->lastOfMonth()->format('Y-m-d');
        
    
        $visit_days = $clinic->visits()
        ->whereDate('visit_date','>=',$request->from ?? $firstDay )
        ->whereDate('visit_date','<=',$request->to ?? $endDay)->get()->groupBy('visit_date');
    

        $visit_days = $clinic->visits()
            ->when($request->from , function ($q) use ($request){
                return $q->whereDate('visit_date','>=',$request->from );
            })->when($request->to , function ($q) use ($request){
                return $q->whereDate('visit_date','<=',$request->to );
            })->get()->groupBy('visit_date');

        $total_income = 0;
        foreach ($visit_days as $day => $day_data) {
            foreach ($day_data as $index => $visit){
                $total_income+=$visit->paid;
            }
        }

        $exports_imports = ExportImport::where('clinic_id',$clinic->id)
        ->when($request->from , function ($q) use ($request){
            return $q->whereDate('created_at','>=',$request->from);
        })->when($request->to,function($q) use($request){
            return $q->whereDate('created_at','<=',$request->to);
        })->get();

        return view('clinics.show',compact('clinic','visit_days','exports_imports','total_income'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic)
    {
        $clinic->update(['name' =>$request->name]);

        $clinic->clinic_fees()->update([
            'visit_cost' => $request->visit_cost,
            're_visit_cost' => $request->re_visit_cost,
            'consultation_cost' => $request->consultation_cost,
        ]);

        Alert::success('Clinic Updated Succesfully', '');
        return redirect()->route('clinics.index');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic)
    {
    
        $clinic->delete();

        Alert::success('Clinic Delete Succesfully', '');
        
        return redirect()->back();    
    
    }
}
