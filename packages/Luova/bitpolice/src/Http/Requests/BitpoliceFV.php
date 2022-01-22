<?php

namespace Luova\Bitpolice\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BitpoliceFV extends FormRequest
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
            'menu_id' => 'required',
            'designation' => 'required|max:191',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];
    }
}
