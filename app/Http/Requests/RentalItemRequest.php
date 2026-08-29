<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentalItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rental_id' => ['required', 'exists:rentals,id'],
            'gear_id'   => ['required', 'exists:gears,id'],
            'qty'       => ['required', 'integer', 'min:1'],
        ];
    }
}
