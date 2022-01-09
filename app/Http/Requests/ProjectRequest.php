<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ProjectRequest extends FormRequest
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
            'name'           => 'required',
            'start_end_date' => 'required',
            'description'    => 'required|max:200',
            'scope'          => 'required',
            'credentials'    => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'This :attribute is required',
            'max'      => 'This :attribute must be less than :max characters'
        ];
    }
}
