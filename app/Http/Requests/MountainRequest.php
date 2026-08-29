<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MountainRequest extends FormRequest 
{ 
    public function authorize(): bool
    {
        return true;
    } 

    public function rules(): array
    {
        return [
            'name'               => 'required|string|max:100',
            'location'           => 'required|string|max:100',
            'province'           => 'required|string|max:100',
            'elevation'          => 'required|integer|min:0',
            'difficulty'         => 'required|in:Easy,Medium,Hard',
            'estimated_duration' => 'required|string|max:50',
            'description'        => 'nullable|string',
            'latitude'           => 'nullable|numeric|between:-90,90',
            'longitude'          => 'nullable|numeric|between:-180,180',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'               => 'Nama gunung wajib diisi.',
            'location.required'           => 'Lokasi gunung wajib diisi.',
            'province.required'           => 'Provinsi wajib diisi.',
            'elevation.required'          => 'Ketinggian (elevation) wajib diisi.',
            'elevation.integer'           => 'Ketinggian harus berupa angka bulat (mdpl).',
            'difficulty.required'         => 'Tingkat kesulitan (difficulty) wajib dipilih.',
            'difficulty.in'               => 'Tingkat kesulitan hanya boleh: Easy, Medium, atau Hard.',
            'estimated_duration.required' => 'Estimasi durasi pendakian wajib diisi.',
            'latitude.between'            => 'Nilai latitude harus di antara -90 dan 90.',
            'longitude.between'           => 'Nilai longitude harus di antara -180 dan 180.',
        ];
    }
}
