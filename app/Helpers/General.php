<?php

use App\CashPayment;
use App\Month;
use App\Patient;
use App\ProcedurePayment;
use Illuminate\Support\Facades\DB;

function folder_path($path){
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }
}

/**
 * Store a newly created resource in storage.
 *
 * @param  string $path folder name in public
 * @param  $request->image
 * @return string name
 */
function upload_image($path , $image , $width=300 , $height=null)
{
    $path = 'uploads/'.$path ;
    folder_path($path);
    // $image must be a $request->image 
    Intervention\Image\Facades\Image::make($image)->resize($width, $height, function ($constraint) {
        $constraint->aspectRatio();
    })
        ->save(public_path($path.'/'. $image->hashName()));
    return $image->hashName();
}

function upload_image_without_resize($path , $image )
{
    $path = 'uploads/'.$path ;
    folder_path($path);
    // $image must be a $request->image 
    Intervention\Image\Facades\Image::make($image)->save(public_path($path .'/'. $image->hashName()));
    return $image->hashName();
}

function delete_image($folder , $image)
{
    Illuminate\Support\Facades\Storage::disk('public_uploads')->delete('/'.$folder.'/' . $image);
}


function upload_file($path, $request_file){
    $path = 'uploads/'.$path ;
    folder_path($path);
    
    $fileName = rand().time().'.'.$request_file->getClientOriginalExtension();
    $request_file->move(public_path($path), $fileName);
    return $fileName;
}

// function get_settings_by_class($class){
//     return \App\Setting::where('class',$class)->get();
// }

function get_setting_by_key($key){
    return \App\Setting::where('key',$key)->first();
}

function input_has_error($field , $errors){

    return $errors->has($field) ? 'has-error' : '';
}


function get_patient_cash(Patient $patient){
    return ProcedurePayment::where([
        'patient_id' => $patient->id,
        'payment_method' => 'cash'
    ])->sum('procedure_fees');
}

function get_total_cash_down(Patient $patient){
    return ProcedurePayment::where([
        'patient_id' => $patient->id,
        'payment_method' => 'cash'
    ])->sum('pre_paid_amount');
}

function get_patient_cash_remainig(Patient $patient){
    $paid = CashPayment::where([
        'patient_id' =>  $patient->id,
    ])->sum('paid');
    
    return get_patient_cash($patient) - (get_total_cash_down($patient) + $paid);
}

function get_cash_paid(Patient $patient){
    return  CashPayment::where([
        'patient_id' =>  $patient->id,
    ])->sum('paid') + 
        ProcedurePayment::where([
            'patient_id' => $patient->id,
            'payment_method' => 'cash'
    ])->sum('pre_paid_amount');
    
}

function remainig_procedure_payment_cash(ProcedurePayment $procedure_payment){
    return $procedure_payment->procedure->procedure_payment->procedure_fees - $procedure_payment->procedure->procedure_payment->cash_payment->paid ;
}

function is_doctor(){
    return auth()->user()->role == 'doctor';
}

function get_patient_installments_total(Patient $patient){
    return ProcedurePayment::where([
        'patient_id' => $patient->id,
        'payment_method' => 'installments'
    ])->sum('procedure_fees');
}

function get_patient_installments_remainig(Patient $patient){
    $remain = 0;
    foreach ($patient->procedure_payments->where('payment_method','installments') as $index => $procedure_payment){
        $remain += $procedure_payment->installment_payment->months->sum('paid'); 
    }
    return get_patient_installments_total ($patient) - ($remain ) ;
}



function get_col_name($name){
    return str_replace(" ","_",strtolower($name));;
}

function get_last_item_id($array){
    return count($array) > 0 ? $array[count($array)-1] : ['id'=>0]; 
}

function is_current_route($route){
    if(request()->route()->getName() == $route)
        return true;
    return false;
}

function is_active($route){
    return is_current_route($route) ? 'side-menu--active' : '';
}

function drop_active(){
    if(is_current_route('reports.surgeries') || is_current_route('reports.non_surgeries') 
        || is_current_route('reports.surgeries_payment') || is_current_route('reports.hospitals') 
        || is_current_route('reports.patients'))
    {
        return true;
    }
    return false;
}


function hospital_surgery($hospital_id , $surgery_id){
    // DB::table('procedure_payments')
    // ->select('users.id','users.name','profiles.photo')
    // ->join('profiles','profiles.id','=','users.id')
    // ->where(['something' => 'something', 'otherThing' => 'otherThing'])
    // ->get();

    $pp = DB::table('procedure_payments')
    ->join('procedures','procedures.id','=','procedure_payments.procedure_id')
    ->where(['procedure_payments.hospital_id' => $hospital_id, 'procedures.surgery_id' =>  $surgery_id])
    ->get();
}


?>