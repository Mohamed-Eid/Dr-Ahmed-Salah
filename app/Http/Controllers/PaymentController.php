<?php

namespace App\Http\Controllers;

use App\CashPayment;
use App\Month;
use App\Procedure;
use App\ProcedurePayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    public function pay_cash(Request $request , CashPayment $cash_payment){
        $cash_payment->update([
            // 'paid' => $request->paid,
            'paid' => $cash_payment->procedure_payment->remainig(),
        ]);
        
        Alert::success('Paid Succesfully', 'Success Message');
        return redirect()->back();
    }

    public function pay_month(Request $request , Month $month){
        $month->update([
            'paid' => $month->paid + $request->paid
        ]);
        Alert::success('Paid Succesfully', 'Success Message');
        return redirect()->back();   
    }

    public function make_payment(Request $request, Procedure $procedure){
        //TODO : Validate Request
        // dd($request->all());

        $method = $request->payment_method;
        
        $procedure_payment = $procedure->procedure_payment()->create([
            'patient_id'          =>  $procedure->patient_id,
            'hospital_id'         =>  $request->hospital_id,
            'surgery_id'          =>  $procedure->surgery_id,
            'offer'               =>  $request->offer ? 1 : 0,
            'payment_method'      =>  $method,
            'procedure_fees'      =>  $request->procedure_fees,
            'hospital_cost'       =>  $request->hospital_cost,
            'hospital_other_fees' =>  $request->hospital_other_fees,
            'pre_paid_amount'     =>  $request->pre_paid_amount,
            'doctor_fees'         => $request->procedure_fees - ($request->hospital_other_fees +$request->hospital_cost ) 
        ]);

        if($method=='cash'){
            $this->cash_payment($procedure_payment, $procedure->patient_id);
        }elseif($method == 'installments'){
            $this->installment_payment($request, $procedure_payment, $procedure->patient_id);
        }

        Alert::success('Payment Added Succesfully', 'Success Message');
        return redirect()->back();
    }

    private function cash_payment(ProcedurePayment $procedure_payment , $patient_id){
        $procedure_payment->cash_payment()->create([
            'procedure_id' => $procedure_payment->procedure_id,
            'hospital_id'  => $procedure_payment->hospital_id,
            'patient_id'   => $patient_id,
            'paid'         => 0
        ]);
    }

    private function installment_payment(Request $request, ProcedurePayment $procedure_payment , $patient_id){
        $installment_payment = $procedure_payment->installment_payment()->create([
            'procedure_id'  => $procedure_payment->procedure_id,
            'hospital_id'   => $procedure_payment->hospital_id,
            'month_count'   => $request->month_count,
            'patient_id'    => $patient_id,
            'month_fees'    => ($request->procedure_fees - $procedure_payment->pre_paid_amount) / $request->month_count ,
            'start_month'   => $request->start_month//date('Y-m-d', strtotime('+1 month')),
        ]);


        
        for ($i=0; $i <= $request->month_count ; $i++) { 
            $date = new Carbon($installment_payment->start_month); 

            $installment_payment->months()->create([
                'hospital_id'    => $request->hospital_id,
                'procedure_id'   => $procedure_payment->procedure_id,
                'month'          => $date->addMonths($i),
            ]);
        }

    }
    
}
