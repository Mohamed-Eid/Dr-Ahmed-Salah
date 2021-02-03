<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\Http\Requests\CreatePatientRequest;
use App\Patient;
use App\Visit;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        
        $patients = Patient::when($request->search , function ($q) use ($request){
            return $q->where('name','like','%'.$request->search.'%')
            ->orWhere('phone_1','like','%'.$request->search.'%')
            ->orWhere('phone_2','like','%'.$request->search.'%');
        })->latest()->get();//->paginate(10);

        $clinics  = Clinic::all();
        return view('patients.index',compact('patients','clinics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hear_about_us = get_setting_by_key('hear_about_us')->details;
        $hear_about_us = json_decode($hear_about_us);
        $clinics = Clinic::all();
        $chronic_diseases = get_setting_by_key('chronic_disease')->details;
        $chronic_diseases = json_decode($chronic_diseases);

        return view('patients.create',compact('hear_about_us','clinics','chronic_diseases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePatientRequest $request)
    {
        // dd($request->all());

        $data = $request->except('image' , 'visit');
        if($request->has('image')){
            $data['image'] = upload_image_without_resize('patient_images',$request->image);
        }



        if ($request->visit) {
            $request->validate([
                'visit.date' => 'required',
                'visit.time' => 'required'
            ]);
        }

        $patient = Patient::create($data);

        if($request->visit){
            $patient->visits()->create([
                'visit_date' => $request->visit['date'],
                'visit_time' => $request->visit['time'],
            ]);
        }

        if ($request->chronic_diseases) {
            foreach ($request->chronic_diseases as $key => $value) {
                get_setting_by_key('chronic_disease')->updateCount($key);
            }
        }


        get_setting_by_key('hear_about_us')->updateCountByValue($request->how_hear_about_us);

        Alert::success('Patient Added Succesfully', '');
        
        return redirect()->route('patients.index');
        //return redirect()->route('patients.index')->with('success',__('site.saved_successfuly'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return view('patients.show',compact('patient'));
    }

    public function show_payment(Patient $patient)
    {
        return view('patients.payment',compact('patient'));
    }

    //TODO: SELECTion And EDit And texts with yes or no
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {

        $hear_about_us = get_setting_by_key('hear_about_us')->details;
        $hear_about_us = json_decode($hear_about_us);

        $chronic_diseases = get_setting_by_key('chronic_disease')->details;
        $chronic_diseases = json_decode($chronic_diseases);

        $clinics = Clinic::all(); 

        return view('patients.edit',compact('patient','hear_about_us','clinics','chronic_diseases'));
    }

    public function edit_all(Request $request ,Patient $patient){
        $patient_complaints = get_setting_by_key('patient_complaints')->details;
        $patient_complaints = json_decode($patient_complaints);

        $examinations = get_setting_by_key('examinations')->details;
        $examinations = json_decode($examinations);

        $diagnosis = get_setting_by_key('diagnosis')->details;
        $diagnosis = json_decode($diagnosis);


        $plan_items = get_setting_by_key('plan_items')->details;
        $plan_items = json_decode($plan_items);

        $investigations = get_setting_by_key('investigations')->details;
        $investigations = json_decode($investigations);


        $visit = $patient->visits->first() ?? $patient->visits()->create([
            'visit_date'  => date('Y-m-d'),
            'clinic_id'   => Clinic::first()->id,
            'visit_time'  => date("H:i:s"),
            'user_id'     => $request->user()->id
            ]);
        
        return view('visits.show', compact('visit','patient_complaints','examinations','diagnosis','plan_items','investigations'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $data = $request->except('image');
        
        if($request->has('image')){
            delete_image('patient_images',$patient->image);
            $data['image'] = upload_image_without_resize('patient_images',$request->image);
        }

        $patient->update($data);
        
        Alert::success('Patient Updated Succesfully', '');
        return redirect()->route('patients.index');
        //return redirect()->route('patients.index')->with('success',__('site.saved_successfuly'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        delete_image('patient_images',$patient->image);
        $patient->delete();

        Alert::success('Patient Deleted Succesfully', '');

        return redirect()->back();//->with('success',__('site.deleted_successfully'));
    }
}
