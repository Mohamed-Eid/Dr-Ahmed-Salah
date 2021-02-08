<?php

namespace App\Http\Controllers;

use App\Category;
use App\Drug;
use App\Visit;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DrugStoreController extends Controller
{
    public function index(){
        $categories = Category::all();
        $drugs = Drug::all();
        return view('drug_store.index',compact('categories','drugs'));
    }

    public function store(Request $request , Visit $visit){
        
        // dd($request->all());
        $request->validate([
            'non_surgery_id' => 'required',
            'nonsurgery' => 'required'
        ]);

        $patient = $visit->patient;

        foreach ($request->nonsurgery as $key => $data) {
            $in_procedure = $patient->in_procedures()->create([
                'visit_id'       => $visit->id,
                'non_surgery_id' => $request->non_surgery_id,
                // 'drug_id'  => $key,
                // 'amount'   => $data['amount'],
                // 'comment'  => $data['comment'],
            ]);

            if($in_procedure){
                $in_procedure->drugs()->attach($key,[
                    'drug_id'  => $key,
                    'amount'   => $data['amount'],
                    'comment'  => $data['comment'],
                ]);
                // $in_procedure->drugs()->create([
                //     'drug_id'  => $key,
                //     'amount'   => $data['amount'],
                //     'comment'  => $data['comment'],
                // ]);
                $drug = Drug::find($key);
                $drug->update([
                    'amount' => ($drug->amount - $data['amount'])
                ]);
            }
        }



        Alert::success('Non Surgery Procedure Added Succesfully', '');

        return redirect()->back();
    }

}
