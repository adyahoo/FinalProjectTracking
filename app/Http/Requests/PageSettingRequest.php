<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageSettingRequest extends FormRequest
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
            'title' => 'required|max:15',
            'logo'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'This :attribute collumn is Required!',
            'min'      => 'Your :attribute min length :min character long',
            'max'      => 'Your :attribute max length :max character long',
            'logo.max' => 'Your :attribute is only valid :max MB or less',
            'image'    => 'Your :attribute is only valid JPEG, JPG, PNG, GIF',
        ];
    }
}
