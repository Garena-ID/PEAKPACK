<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rental_date'     => ['required', 'date', 'after_or_equal:today'],
            'due_date'        => ['required', 'date', 'after_or_equal:rental_date'],
            'items'           => ['required', 'array', 'min:1'],
            'items.*.gear_id' => ['required', 'exists:gears,id'],
            'items.*.qty'     => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'rental_date.required'       => 'Tanggal pengambilan wajib diisi.',
            'rental_date.after_or_equal' => 'Tanggal pengambilan tidak boleh lebih kecil dari hari ini.',
            'due_date.required'          => 'Tanggal pengembalian wajib diisi.',
            'due_date.after_or_equal'    => 'Tanggal pengembalian tidak boleh lebih kecil dari tanggal pengambilan.',
            'items.required'             => 'Pilih minimal 1 perlengkapan untuk disewa.',
            'items.min'                  => 'Pilih minimal 1 perlengkapan untuk disewa.',
            'items.*.gear_id.required'   => 'Perlengkapan wajib dipilih.',
            'items.*.gear_id.exists'     => 'Perlengkapan yang dipilih tidak ditemukan.',
            'items.*.qty.required'       => 'Jumlah unit wajib diisi.',
            'items.*.qty.min'            => 'Jumlah unit minimal 1.',
        ];
    }
}
