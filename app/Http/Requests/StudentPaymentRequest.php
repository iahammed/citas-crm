<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentPaymentRequest extends FormRequest
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
            'pMethod' => ['required'],
            'first_name' => ['required'],
            'paydate' => ['required', 'date'],
            'amount' => ['required', 'numeric']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'pMethod.required' => 'Method of payment is required',
            'paydate.required' => 'Payment date is required',
            'paydate.date' => 'Payment date is must be date nothing else allowed',
        ];
    }
}
