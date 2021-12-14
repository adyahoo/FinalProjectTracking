<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
            'name'        => 'required',
            'email'       => 'required',
            'gender'      => 'required',
            'division_id' => 'required',
            'role_id'     => 'required',
        ];

        if($this->method() == 'POST'){
            array_walk($rules, function (&$value, $key) {
                if($key == 'email'){ 
                    $value = 'required|unique:users'; 
                }
            });
        }
        

        return $rules;
    }

    public function messages()
    {
        return [
            'unique'   => 'This :attribute column must be a unique value',
            'required' => 'This :attribute collumn is Required!',
        ];
    }
}
