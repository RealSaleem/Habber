<?php

namespace App\Http\Requests\Api;
use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'email' => ['required','email'],
            'password' => ['bail', 'required', 'string', 'min:8', 'confirmed'],
            'remember_token' => ['bail']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    
}