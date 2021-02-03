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
        Clinic::create(['name' =>$request->name]);

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
