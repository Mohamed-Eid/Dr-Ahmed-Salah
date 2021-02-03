<?php

namespace App\Http\Controllers;

use App\Patient;
use App\PatientImage;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DoctorInfoController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Patient $patient)
    {
        //dd($request->all());
        //TODO: validate request
        $data = $request->except('patient_images','complaints','examinations','diagnosis','plans');
        
        $data['patient_photo_taken'] = $request->consent_signed ? 1 : 0;
        $data['consent_signed'] = $request->consent_signed ? 1 : 0;

        $patient->doctor_info()->create($data);

        if($request->has('complaints')){
            foreach ($request->complaints as $key => $comment) {
                $patient->patient_complaints()->create([
                    'key' => $key,
                    'comment' => $comment
                ]);
                get_setting_by_key('patient_complaints')->updateCount($key);
            }
        }

        if($request->has('examinations')){
            foreach ($request->examinations as $key => $comment) {
                $patient->patient_examinations()->create([
                    'key' => $key,
                    'comment' => $comment
                ]);
            }
            get_setting_by_key('examinations')->updateCount($key);
        }

        if($request->has('diagnosis')){
            foreach ($request->diagnosis as $key => $comment) {
                $patient->patient_diagnoses()->create([
                    'key' => $key,
                    'comment' => $comment
                ]);
            }
            get_setting_by_key('diagnosis')->updateCount($key);

        }

        if($request->has('plans')){
            foreach ($request->plans as $key => $comment) {
                $patient->patient_plans()->create([
                    'key' => $key,
                    'comment' => $comment
                ]);
            }
            get_setting_by_key('plan_items')->updateCount($key);

        }


        if($request->has('patient_images')){
            foreach ($request->patient_images as $image) {
                $patient->patient_images()->create([
                    'image' => upload_image_without_resize('examination_images',$image)
                ]
                );
                
            }
        }


        Alert::success('Data Updated Succesfully', '');

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  Patient $patient)
    {
        // dd($request->all());
        // $data = $request->except('images','_token','_method');
        $data = $request->except('_token','_method','patient_images','complaints','examinations','diagnosis','plans');

        $patient->doctor_info()->update($data);

        $this->update_addoinal($request , $patient , 'complaints' , 'patient_complaints' , 'patient_complaints');

        $this->update_addoinal($request , $patient , 'examinations' , 'patient_examinations' , 'examinations');

        $this->update_addoinal($request , $patient , 'diagnosis' , 'patient_diagnoses' , 'diagnosis');

        $this->update_addoinal($request , $patient , 'plans' , 'patient_plans' , 'plan_items');


        if($request->has('patient_images')){
            foreach ($request->patient_images as $image) {
                $patient->patient_images()->create([
                    'image' => upload_image_without_resize('examination_images',$image)
                ]
                );    
            }
        }

        Alert::success('Data Updated Succesfully', '');

        return redirect()->back();
    }

    private function update_addoinal(Request $request, Patient $patient , $fields  ,$relation , $setting_name){

        //TODO : DELETE Then Construct
        if($request->$fields){
            foreach ($request->$fields as $key => $comment) {
                if($patient->$relation){
                    if($patient->$relation->where('key',$key)->first()){
                        $patient->$relation->where('key',$key)->first()->update([
                            'comment' => $comment
                        ]);
                    }else{
                        $patient->$relation()->create([
                            'key' => $key,
                            'comment' => $comment
                        ]);
                        get_setting_by_key($setting_name)->updateCount($key);
                    }
                }else{
                    $patient->$relation()->create([
                        'key' => $key,
                        'comment' => $comment
                    ]);
                    get_setting_by_key($setting_name)->updateCount($key);
                }
            }
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete_image(PatientImage $patient_image){
        // dd($patient_image);
        delete_image('examination_images',$patient_image->image);
        $patient_image->delete();
        Alert::success('Image Deleted Succesfully', '');
        return redirect()->back();
    }
    public function destroy($id)
    {
        //
    }
}
