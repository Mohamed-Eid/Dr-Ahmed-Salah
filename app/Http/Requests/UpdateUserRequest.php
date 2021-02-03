<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $rules = [
            'name'     => 'required',
            'email'    => 'required|unique:users,email,'.$this->route('user')->id,
            'phone'    => 'required|unique:users,phone,'.$this->route('user')->id,
            'address'  => 'required',
            'salary'   => 'required',
        ];

        if($this->has('passwprd')){
            $rules += ['password' => 'required|confirmed'];
        }

        return $rules;
    }
}
