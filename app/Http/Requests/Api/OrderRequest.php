<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'product.*.price' => ['bail','required','min:1'],
            'address_id' => ['bail','required'],
            'currency_id'=>['bail','required'],
            'total_price' => ['bail', 'required'],
            'total_quantity' => ['bail','required']
        ];
    }
}
