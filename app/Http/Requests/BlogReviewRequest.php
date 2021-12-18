<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogReviewRequest extends FormRequest
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
            'status' => 'required',
            'reviews' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'This :attribute collumn is Required!',
        ];
    }
}
