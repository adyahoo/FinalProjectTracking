<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectVersionRequest extends FormRequest
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
            'description' => 'required',
            'note'        => 'required'
        ];

        if($this->method() == 'POST'){
            $rules += [
                'major' => 'required',
                'minor' => 'required',
                'patch' => 'required'
            ]; 
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'A :attribute is required'
        ];
    }
}
