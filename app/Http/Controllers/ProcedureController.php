<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProcedureRequest;
use App\Visit;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, Visit $visit)
    {
        // dd($visit);
        // dd($request->all());
        $data = $request->except('surgents','assistants','anesthesia');
        $data['visit_id'] = $visit->id;

        $procedure = $visit->patient->procedures()->create($data);

        if($request->has('surgents')){
            foreach ($request->surgents as $key => $comment) {
                $procedure->procedure_surgents()->create([
                    'key' => $key,
                    'comment' => $comment
                ]);
                get_setting_by_key('main_surgent')->updateCount($key);

            }
        }


        if($request->has('assistants')){
            foreach ($request->assistants as $key => $comment) {
                $procedure->procedure_assistants()->create([
                    'key' => $key,
                    'comment' => $comment
                ]);
                get_setting_by_key('assistants')->updateCount($key);
            }
        }


        if($request->has('anesthesia')){
            foreach ($request->anesthesia as $key => $comment) {
                $procedure->procedure_anesthesias()->create([
                    'key' => $key,
                    'comment' => $comment
                ]);
                get_setting_by_key('types_of_anesthesia')->updateCount($key);
            }
        }


        Alert::success('Procedure Added Succesfully', 'Success Message');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
