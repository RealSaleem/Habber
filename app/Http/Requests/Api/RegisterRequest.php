<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class RegisterRequest extends FormRequest
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
            'email' => ['bail', 'required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['bail', 'required', 'string', 'min:8', 'confirmed'],
            'language_id' => ['required']
        ];
    }

    public function response(array $error)
    {
        return response()->json(['error' => $error], 422);
    }
    
    public function failedValidation(Validator $validator)
    {
        $messages = $validator->errors()->getMessages();
        $error_messages = '';
        foreach($messages as $message) {
            $error_messages .= $message[0] . ' ';
        }
        $response = ['status' => false,'message' => $error_messages, 'errors' => $validator->errors() ];
        throw new HttpResponseException(response()->json($response, 422)); 
        
    }
}
