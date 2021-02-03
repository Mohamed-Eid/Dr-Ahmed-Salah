<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\Http\Requests\CreateClinicRequest;
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
