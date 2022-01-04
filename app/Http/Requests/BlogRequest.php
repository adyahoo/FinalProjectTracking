<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'blog_category_id' => 'required',
            'title'            => 'required|min:10|max:60',
            'content'          => 'required|min:100',
            'status'           => 'required',
            'slug'             => 'nullable|min:10|max:70',

        ];

        if($this->method() == 'PUT'){
            $rules += [
                'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'meta_title'       => 'required|min:10|max:60',
                'meta_description' => 'required|min:30',
            ]; 
        }else{
            $rules += [
                'image'            => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'meta_title'       => 'nullable|min:10|max:60',
                'meta_description' => 'nullable|min:30',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'blog_category_id.required' => 'Blog category is required',
            'required'                  => 'This :attribute collumn is Required!',
            'min'                       => 'Your :attribute min length :min character long',
            'max'                       => 'Your :attribute max length :max character long',
            'image.max'                 => 'Your :attribute is only valid :max MB or less',
            'image'                     => 'Your :attribute is only valid JPEG, JPG, PNG, GIF',
        ];
    }
}
