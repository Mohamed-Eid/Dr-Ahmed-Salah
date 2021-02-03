<?php

namespace App\Http\Controllers;

use App\Procedure;
use App\Visit;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $visits = Visit::where('visit_date',date('Y-m-d'))->orderBy('status', 'desc')->orderBy('visit_time', 'asc')->get();
        $today_visits = Visit::where('visit_date',date('Y-m-d'))->count();
        $checked_in_visits = Visit::where('visit_date',date('Y-m-d'))->where('status',1)->count();
        $procedures_today = Procedure::where('surgery_date',date('Y-m-d'))->count();
        
        //$visits= Visit::all();
       // dd($visits);
        return view('home',compact('visits','today_visits','checked_in_visits','procedures_today'));
    }

    public function check_in(Visit $visit)
    {

        $status = $visit->status;
        if($status == 1){
            $visit->update([
                    'status' => 0 ,
            ]);
            Alert::success('Checked Out', '');

            return redirect()->back();
        }

        $visit->update([
                'status' => 1,
        ]);
                
        Alert::success('Checked In', '');

        return redirect()->back();
    }

    public function finish_visit(Visit $visit)
    {
        $visit->update([
                'status' => 3,
        ]);
        Alert::success('Visit Finished', '');
        return redirect()->route('home');
    }

}
