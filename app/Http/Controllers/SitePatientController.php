<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\Http\Requests\CreatePatientRequest;
use App\Patient;
use App\SitePatient;
use App\SiteVisit;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SitePatientController extends Controller
{
    public function index(){
        // $response = Http::get('https://helmysoliman.com/api/patients');
        // $site_patients = json_decode($response->body()) ;

        // foreach ($site_patients as $key => $patient) {
        //     SitePatient::create([
        //         'name'       => $patient->name,
        //         'refferal'   => $patient->refferal,
        //         'email'      => $patient->email,
        //         'cellphone1' => $patient->cellphone1,
        //         'cellphone2' => $patient->cellphone2,
        //         'nationalid' => $patient->nationalid,
        //         'landline'   => $patient->landline,
        //         'job'        => $patient->job,
        //         'address'    => $patient->address,
        //         'Country'    => $patient->Country,
        //         'BirthDate'  => $patient->BirthDate,
        //     ]);
        // }

        return view('site_patients.index',['site_patients' => SitePatient::paginate(20)]);

        // return 'done';//view('site_patients.index',compact('site_patients'));
    }

    public function create(SiteVisit $site_visit){
        $hear_about_us = get_setting_by_key('hear_about_us')->details;
        $hear_about_us = json_decode($hear_about_us);
        $clinics = Clinic::all();
        $chronic_diseases = get_setting_by_key('chronic_disease')->details;
        $chronic_diseases = json_decode($chronic_diseases);

        return view('site_patients.create',compact('hear_about_us','clinics','chronic_diseases' , 'site_visit'));
    }


    public function store(CreatePatientRequest $request, SiteVisit $site_visit)
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
                'clinic_id'  => $request->visit['clinic_id'],
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

        $site_visit->delete();

        Alert::success('Patient Added Succesfully', '');
        
        return redirect()->route('online_visits');
    }


}
