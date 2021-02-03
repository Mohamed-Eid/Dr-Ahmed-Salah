<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('ttt',function(){
    dd(date('Y-m-d', strtotime("+1 month")));
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {

    Route::get('old_patients','SitePatientController@index');
    
    Route::get('site_patients/{site_visit}','SitePatientController@create')->name('site_patient.create');
    Route::post('site_patients/{site_visit}','SitePatientController@store')->name('site_patient.store');

    Route::get('onine_visits','SiteVisitController@index')->name('online_visits');
    Route::delete('delete_online_visits/{site_visit}','SiteVisitController@destroy')->name('delete_online_visits');


    Route::get('home','HomeController@index')->name('home');
    
    Route::resource('users', 'UserController')->middleware('is_doctor');

    Route::get('change_password','UserController@edit_password')->name('edit_password');

    Route::put('update_passowrd','UserController@update_password')->name('update_password');


    Route::resource('clinics', 'ClinicController')->middleware('is_doctor');;
    Route::resource('patients', 'PatientController');

    Route::get('patient_payment/{patient}','PatientController@show_payment')->name('show_payment');
    Route::get('patient_edit/{patient}','PatientController@edit_all')->name('patients.edit_all');


    Route::resource('visits', 'VisitController');
    
    Route::resource('{visit}/investigations', 'InvestigationController');
    Route::put('/investigations/update_all/{visit}', 'InvestigationController@investigation_update')->name('investigation_update');
    Route::get('/investigations/delete_file/{investigation_file}', 'InvestigationController@delete_file')->name('delete_file');
    Route::get('/visits/delete_file/{visit_file}', 'VisitController@delete_file')->name('visits.delete_file');

    Route::resource('{visit}/procedures', 'ProcedureController');


    Route::post('{cash_payment}/payment','PaymentController@pay_cash')->name('cash_payment');
    Route::post('{month}/pay_month','PaymentController@pay_month')->name('pay_month');

    Route::post('{procedure}/make_payment','PaymentController@make_payment')->name('make_payment');

    Route::get('check_in/{visit}', 'HomeController@check_in')->name('check_in');
    Route::put('delay/{visit}', 'VisitController@delay')->name('visits.delay');
    Route::get('finish_visit/{visit}', 'HomeController@finish_visit')->name('finish_visit');
    Route::post('{visit}/pay','VisitController@pay_visit')->name('pay_visit');


    Route::post('doctor_info/{patient}', 'DoctorInfoController@store')->name('doctor_info.store')->middleware('is_doctor');;
    Route::put('doctor_info/{patient}/edit', 'DoctorInfoController@update')->name('doctor_info.update');

    Route::get('edit_profile',function (){
        return view('users.edit_profile');
    })->name('edit_profile');  


    Route::put('update_profile', 'UserController@update_profile')->name('update_profile');
    
    Route::resource('surgeries', 'SurgeryController')->middleware('is_doctor');;
    Route::resource('hospitals', 'HospitalController')->middleware('is_doctor');;


    // Route::get('settings','SettingController@index')->name('settings.index');
    
    Route::get('settings/system','SettingController@index_system')->name('settings.system')->middleware('is_doctor');;

    Route::put('settings/system','SettingController@update_system')->name('settings.update_system')->middleware('is_doctor');;
    Route::put('settings','SettingController@update')->name('settings.update')->middleware('is_doctor');;

    Route::delete('settings/system/{setting}/{item_id}','SettingController@delete_system')->name('settings.delete_system')->middleware('is_doctor');;

    Route::get('delete_image/{patient_image}','DoctorInfoController@delete_image')->name('expectaions.delete_image')->middleware('is_doctor');;

    Route::group(['prefix' => 'reports'], function () {
        Route::get('surgeries','ReportController@surgeries')->name('reports.surgeries')->middleware('is_doctor');;
        Route::get('surgeries_payment','ReportController@surgeries_payment')->name('reports.surgeries_payment')->middleware('is_doctor');
        Route::get('hospitals','ReportController@hospitals')->name('reports.hospitals')->middleware('is_doctor');
        Route::get('patients','ReportController@patients')->name('reports.patients');
        Route::get('patients/{patient}/cash','ReportController@patient_cash')->name('reports.patient_cash');
        Route::get('patients/{patient}/patient_installmets','ReportController@patient_installmets')->name('reports.patient_installmets');
    });
    

    Route::group(['prefix' => 'drug_store'], function () {
        Route::get('/','DrugStoreController@index')->name('drug_store.index');
        Route::post('{visit}/save','DrugStoreController@store')->name('drug_store.save');
    });

    Route::resource('categories', 'CategoryController');
    Route::resource('drugs', 'DrugController');

});



