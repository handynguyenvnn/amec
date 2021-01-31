<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
        $langRule = 'required|max:32|unique:languages';
        $langCodeRule = 'required|max:32|unique:languages';
        if($this->method() == 'PUT'){
            $langRule = 'required|max:32';
            $langCodeRule = 'required|max:32';
        }
        return [
            'lang' => $langRule,
            'lang_code' => $langCodeRule
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
//            'lang.required' => 'Language is require',
//            'lang.unique' => 'Language is exist',
//            'lang_code.required' => 'Language code is require',
//            'lang_code.unique' => 'Language code is exist',
        ];
    }
}
