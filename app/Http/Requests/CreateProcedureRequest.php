<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProcedureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'surgery_id'             => 'required',
            'surgery_date'           => 'required',
            'operative_time'         => 'required',
            'discharge_date'         => 'required',
            'complications_status'   => 'required',
            'surgents'               => 'array|min:1|required',
            'assistants'             => 'array|min:1|required',
            'anesthesia'             => 'array|min:1|required',
        ];
    }
}
