<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'product.*.product_id' => ['bail', 'required','min:1'],
            'product.*.product_type' => ['bail', 'required','min:1'],
            'product.*.quantity' => ['bail','required','min:1'],
            'total_price' => ['bail','required'],
            'product.*.price' => ['bail','required','min:1']
        ];
    }
}
