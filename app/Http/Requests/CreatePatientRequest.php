<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                      => 'required',
            'dob'                       => 'required',
            'gender'                    => 'required',
            'marital_status'            => 'required',
            'job_title'                 => 'required',
            'phone_1'                   => 'required|unique:patients',
            'email'                     => 'required|unique:patients',
            'country'                   => 'required',
            'address'                   => 'required',
            'how_hear_about_us'         => 'required',
            'drug_status'               => 'required',
            'smoking_status'            => 'required',
            'blood_transfusion_status'  => 'required',
            'alcoholic_status'          => 'required',
            'previous_sergeries_status' => 'required',
            'family_history_status'     => 'required',
            //'medications_text'        => 'required',
        ];
    }
}
