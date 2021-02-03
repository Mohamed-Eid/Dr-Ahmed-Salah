<?php

namespace App\Http\Controllers;

use App\Investigation;
use App\InvestigationFile;
use App\Visit;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InvestigationController extends Controller
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
        $patient = $visit->patient;
        

        if ($request->investigations) {
            foreach ($request->investigations as $key => $value) {
                $investigation = $patient->investigations()->create([
                    'key' => $key,
                    'comment' => $value['data'][0]
                ]);
                
                if($value['files']){
                    foreach ($value['files'] as $file) {
                        $investigation->investigation_files()->create([
                            'file' => upload_file('investigations',$file)
                        ]);
                    }
                }
                get_setting_by_key('investigations')->updateCount($key);
            }
            
            Alert::success('Data Updated Succesfully', '');

            return redirect()->back();
        }
        

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
    public function update(Request $request ,Investigation $investigation)
    {
        dd($request->all());
    }

    public function investigation_update(Request $request ,Visit $visit )
    {
        //  dd($request->all());

        $patient = $visit->patient;
        
        $keys = $patient->investigations->pluck('key')->toArray();

        if ($request->investigations) {
            foreach ($request->investigations as $key => $value) {
                if (in_array($key,$keys)) {
                    $investigation = $patient->investigations->where('key',$key)->first();
                    if($investigation){
                        $investigation->update([
                            'comment' => $value['data'][0]
                        ]);
                    }
                }
                else{
                    $investigation = $patient->investigations()->create([
                        'key' => $key,
                        'comment' => $value['data'][0]
                    ]);
                }

                if(isset($value['files'])){
                    foreach ($value['files'] as $file) {
                        $investigation->investigation_files()->create([
                            'file' => upload_file('investigations',$file)
                        ]);
                    }
                }

                
                get_setting_by_key('investigations')->updateCount($key);
            }
            
        }

        Alert::success('Data Updated Succesfully', '');

        return redirect()->back();
    }
    

    public function delete_file(Request $request, InvestigationFile $investigation_file){
        delete_image('investigations',$investigation_file->file);
        $investigation_file->delete();

        Alert::success('Data Deleted Succesfully', '');

        return redirect()->back();
    }
        
        // dd($request->investigations);
        // if ($request->investigations) {
        //     foreach ($request->investigations as $key => $value) {
        //         $investigation = Investigation::find($key);
                
        //         $investigation->update([
        //             'comment' => $value['data'][0]
        //         ]);
                
        //         // if($value['files']){
        //         //     foreach ($value['files'] as $file) {
        //         //         $investigation->investigation_files()->create([
        //         //             'file' => upload_file('investigations',$file)
        //         //         ]);
        //         //     }
        //         // }

        //         // get_setting_by_key('investigations')->updateCount($key);
        //     }
            
        //     Alert::success('Data Updated Succesfully', '');

        //     return redirect()->back();
        // }    
    

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
