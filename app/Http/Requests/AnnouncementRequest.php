<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AnnouncementRequest extends FormRequest
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

        if($this->method() == 'PUT')
        {
            $validateSubject = 'required|string|max:256';
        }
        if($this->method() == 'POST')
        {
            $validateSubject = 'required|string|max:256';
        }

        $rule = [
            'subject' => $validateSubject
        ];
        return  $rule;
    }
}
