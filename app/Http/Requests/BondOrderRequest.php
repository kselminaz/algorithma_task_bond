<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BondOrderRequest extends FormRequest
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
            'order_date'=>['required','date'],
            'order_count'=>['required','numeric','min:1'],

        ];
    }

}
