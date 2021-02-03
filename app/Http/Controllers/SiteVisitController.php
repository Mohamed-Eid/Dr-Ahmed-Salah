<?php

namespace App\Http\Controllers;

use App\SiteVisit;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SiteVisitController extends Controller
{

    public function index(Request $request){

        $visits = SiteVisit::when($request->from , function ($q) use ($request){
            return $q->where('fav_date','>=',$request->from);
        })->when($request->to,function($q) use($request){
            return $q->where('fav_date','<=',$request->to);
        })->latest()->paginate(20);

        // dd($visits);

        return view('site_patients.visits',['visits' =>  $visits ]);
    }

    public function store(Request $request){
        // return $request->all();
        $visit = SiteVisit::create([
            'name'     => $request->name,
            'phone'    => $request->phone,
            'email'    => $request->email,
            'country'  => $request->country,
            'dob'      => $request->dob,
            'fav_date' => $request->fav_date,
        ]);

        return $visit;
    }

    public function destroy(SiteVisit $site_visit){
        $site_visit->delete();
        Alert::success('Resevation Deleted Succesfully', 'Success Message');
        return redirect()->back();
    }
}