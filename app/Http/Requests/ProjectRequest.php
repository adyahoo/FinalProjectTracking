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
    public $validator = null;

    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator) {
        $this->validator = $validator;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'      => 'required',
            'start_date' => 'required',
            'end_date'   => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required'      => 'A title is required',
            'start_date.required' => 'A start date is required',
            'end_date.required'   => 'A end date is required'
        ];
    }
}
