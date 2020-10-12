<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'address_name'   => ['bail', 'required', 'string', 'max:255', 'min:1'],
            'country_id'     => ['bail', 'required'],
            'state'          => ['required','string','max:15','min:3'],
            'city'           => ['bail', 'required',  'string', 'max:255', 'min:3'],
            'address_line1' => ['bail', 'required',  'string', 'max:255', 'min:3'],
            'address_line2' => ['bail', 'required',  'string', 'max:255', 'min:3'],
            'phone'          => ['bail','required',  'numeric', 'digits_between:11,15'],
            'user_id'        => ['bail','required']
        ];
    }
}