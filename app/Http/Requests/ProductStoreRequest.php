<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'sku' => 'required|unique:products,sku|max:20',
            'name' => 'required|max:255',
            'slug' => 'required|unique:products,slug|max:255',
            'price' => 'nullable|numeric',
            'cost' => 'nullable|numeric',
            'stock' => 'nullable|numeric',
            'mass' => 'required|max:255',
            'made_in' => 'required|max:255',
            'status' => 'required|numeric',
            'thumbnail' => 'nullable|image|max:1024',
            'images.*' => 'nullable|image|max:2048',
            'categories.*' => 'nullable|numeric',
            'product_type' => 'required|numeric',
            'date_available' => 'nullable|date_format:Y-m-d'
        ];
    }
}
