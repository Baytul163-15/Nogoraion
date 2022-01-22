<?php

namespace Luova\Contact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ContactFV extends FormRequest
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
        return [
            'to_mail' => 'required',
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',

        ];
    }
}
