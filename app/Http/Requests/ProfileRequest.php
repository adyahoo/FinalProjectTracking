<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name'          => 'required',
            'email'         => 'required',
            'gender'        => 'required',
            'birth_date'    => 'required',
            'phone'         => 'required',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bio'           => 'required'
        ];
        

        return $rules;
    }

    public function messages()
    {
        return [
            'unique'            => 'This :attribute column must be a unique value',
            'required'          => 'This :attribute collumn is Required!',
            'profile_image.max' => 'Your :attribute is only valid :max MB or less',
            'profile_image'     => 'Your :attribute is only valid JPEG, JPG, PNG, GIF',
        ];
    }
}
