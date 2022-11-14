<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillUpdateRequest extends FormRequest
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
            'book_id' => 'required|max:255',
            'category' => 'nullable|max:255',
            'customer' => 'nullable|max:255',
            'amount' => 'nullable|numeric',
            'unit_price' => 'nullable|numeric',
        ];
    }
}
