<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MountainRecommendationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $recommendationId = $this->route('recommendation') ? $this->route('recommendation')->id ?? $this->route('recommendation') : null;

        return [
            'mountain_id' => ['required', 'exists:mountains,id'],
            'gear_id'     => [
                'required',
                'exists:gears,id',
                Rule::unique('mountain_recommendations', 'gear_id')
                    ->where(fn ($q) => $q->where('mountain_id', $this->mountain_id))
                    ->ignore($recommendationId),
            ],
        ];
    }
}
