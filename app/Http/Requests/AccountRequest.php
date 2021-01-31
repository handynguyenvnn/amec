<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
        $loginIdRule = 'required|max:64|unique:accounts';
        if($this->method() == 'PUT'){
            $loginIdRule = 'required|max:64';
        }
        return [
            'login_id' => $loginIdRule,
            'password' => 'required',
            'name' => 'required|max:64',
            'roles' => 'required'
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
            'login_id.required' => 'アカウントIDを入力してください。',
            'login_id.unique' => '既に登録されているアカウントIDです。別のアカウントを入力してください。',
            'password.required' => 'パスワードを入力してください。',
            'name.required' => '管理者名を入力してください。',
            'roles.required' => '権限を選択してください。',
        ];
    }
}
