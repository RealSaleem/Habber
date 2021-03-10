<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class JoinUsRequest extends FormRequest
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
            'name' => ['bail', 'required', 'string', 'max:255', 'min:3'],
            'email' => ['bail', 'required', 'string', 'email', 'max:255' ],
            'phone' => ['bail', 'required', 'string','max:15'],
            'business_type' => ['bail', 'required', 'string'],
            'details' => ['bail', 'required', 'string'],
            'product_type' => ['bail', 'required', 'string'],
        ];
    }
}
