<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
    public function rules(Request $request)
    {

        $validateEmail = 'required|email|max:256|unique:email';
        $regexPhone = "/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/";

        if($this->method() == 'PUT')
        {
            $validateEmail = 'required|email|max:256';
        }

        $rule = [
            'username' => 'required|max:64',
            'email' => $validateEmail,
            'phone' => 'regex:'.$regexPhone
        ];

        if ($request->input("password") != "")
        {
            $rule["password"] = "regex:/^\S+\w{8,32}\S{1,}/";
        }

        return  $rule;
    }
}
