<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['string'],
            'calories' => ['required', 'decimal:0,2', 'min:0', 'max:1000'],
            'protein' => ['required', 'decimal:0,2', 'min:0', 'max:1000'],
            'fat' => ['required', 'decimal:0,2', 'min:0', 'max:1000'],
            'carbs' => ['required', 'decimal:0,2', 'min:0', 'max:1000'],
            'product_category_id' => ['required', 'numeric', 'exists:product_categories,id'],
        ];
    }
}
