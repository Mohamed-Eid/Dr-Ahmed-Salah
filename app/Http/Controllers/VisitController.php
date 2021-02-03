<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVisitRequest;
use App\Patient;
use App\Visit;
use App\VisitFile;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $visits = Visit::when($request->from , function ($q) use ($request){
            return $q->where('visit_date','>=',$request->from);
        })->when($request->to,function($q) use($request){
            return $q->where('visit_date','<=',$request->to);
        })->where('status','<',3)->latest()->get();//->paginate(10);

        return view('visits.index',compact('visits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateVisitRequest $request)
    {

        $patient = Patient::find($request->patient_id);

        $visits = $patient->visits->where('visit_date',$request->visit_date);

        if (count($visits) > 0) {
            Alert::error("You can't add more than one resevation in the same day", '');
            return redirect()->back();
        }
        
        Visit::create($request->all());
        Alert::success('Resevation Added Succesfully', 'Success Message');
        return redirect()->route('visits.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Visit $visit)
    {
        // dd(json_decode(get_setting_by_key('assistants')->details)->items );
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
        
        return view('visits.show', compact('visit','patient_complaints','examinations','diagnosis','plan_items','investigations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visit $visit)
    {
        //TODO : validate request
        if($visit->visit_detail){
            $visit->visit_detail()->update(['details'=>$request->details]);
        }else{
            $visit->visit_detail()->create(['details'=>$request->details]);
        }

        if ($request->files) {
            foreach ($request->files as $file) {
                foreach ($file as $request_file) {
                    $visit->visit_files()->create([
                        'file' => upload_file('visits',$request_file),
                    ]);
                }
            }
        }

        Alert::success('Visit Details Updated Succesfully', 'Success Message');
        return redirect()->back();
    }

    public function delay(Request $request, Visit $visit)
    {
        
        $patient = Patient::find($request->patient_id);

        $visits = $patient->visits->where('visit_date',$request->visit_date);

        if (count($visits) > 0) {
            Alert::error("You can't add more than one resevation in the same day", '');
            return redirect()->back();
        }


        $visit->update($request->all());

        Alert::success('Resevation Updated Succesfully', '');
        
        return redirect()->route('visits.index');
    }


    public function delete_file(Request $request, VisitFile $visit_file){
        
        delete_image('visits',$visit_file->file);
        
        $visit_file->delete();

        Alert::success('Data Deleted Succesfully', '');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visit $visit)
    {
        $visit->delete();
        Alert::success('Visit Deleted Successfully', '');
        return redirect()->back();
    }
}
