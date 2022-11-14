<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiptUpdateRequest extends FormRequest
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
            'bill_id' => 'required|numeric',
            'full_name' => 'nullable|max:255',
            'address' => 'nullable|max:255',
            'email' => 'nullable|max:255',
            'phone' => 'nullable|digits_between:10,12',
            'book_id' => 'required|numeric',
            'amount' => 'nullable|numeric',
            'unit_price' => 'nullable|numeric',
            'proceeds' => 'nullable|numeric',
            'amount_owed' => 'nullable|numeric',
            'fall_day' => 'nullable|date_format:Y-m-d'
        ];
    }
}
