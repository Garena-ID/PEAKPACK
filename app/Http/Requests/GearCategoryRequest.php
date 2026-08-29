<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GearCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoryId = $this->route('gear_category') ? $this->route('gear_category')->id ?? $this->route('gear_category') : null;

        return [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('gear_categories', 'name')->ignore($categoryId),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori sudah ada dalam database.',
        ];
    }
}
