<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
            'first_name' => ['bail', 'required', 'string', 'max:255', 'min:3'],
            'last_name' => ['bail', 'required', 'string', 'max:255', 'min:3'],
            'phone' => ['sometimes','required','string','max:15','min:3'],
            'profile_pic' => ['sometimes', 'required', 'image', 'mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'currency_id' => ['required'],
            // 'language_id' => ['required']
        ];
    }
}
