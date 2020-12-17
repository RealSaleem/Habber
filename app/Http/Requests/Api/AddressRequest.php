<?php

namespace App\Http\Requests\Api;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
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
            'city_id'           => ['bail', 'required'],
            'address_line1' => ['bail', 'required',  'string', 'max:255', 'min:3'],
            'address_line2' => ['bail', 'required',  'string', 'max:255', 'min:3'],
            'phone'          => ['bail','required',  'numeric', 'digits_between:11,15'],        
        ];
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
