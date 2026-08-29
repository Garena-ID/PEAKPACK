<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GearRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id'  => ['required', 'exists:gear_categories,id'],
            'name'         => ['required', 'string', 'max:150'],
            'stock'        => ['required', 'integer', 'min:0'],
            'rental_price' => ['required', 'numeric', 'min:0'],
            'description'  => ['nullable', 'string'],
        ];
    }
}
