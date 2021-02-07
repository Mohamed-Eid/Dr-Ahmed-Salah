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
        
        dd($request->all());
        $request->validate([
            'nonsurgery' => 'required'
        ]);

        $patient = $visit->patient;

        foreach ($request->nonsurgery as $key => $data) {
            
            if($patient->in_procedures()->create([
                'visit_id' => $visit->id,
                'drug_id'  => $key,
                'amount'   => $data['amount'],
                'comment'  => $data['comment'],
            ])){
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
