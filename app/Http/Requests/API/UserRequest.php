<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'device_id' => 'required',
            'username' => 'required',
            'gender' => 'required',
            'area_id' => 'required',
            'phone' => 'required',
            'profession_id' => 'required',
            'language_id' => 'required',
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
            'email.required' => 'Email is require',
            'email.email' => 'Email is not valid',
            'email.unique' => 'Email is exist',
            'password.required' => 'Password is require',
            'device_id.required' => 'Device id is require',
            'username.required' => 'Username is require',
            'gender.required' => 'Gender is require',
            'area_id.required' => 'Area id is require',
            'phone.required' => 'Phone id is require',
            'profession_id.required' => 'Profession id id is require',
            'language_id.required' => 'Language id id is require',
        ];
    }
}
