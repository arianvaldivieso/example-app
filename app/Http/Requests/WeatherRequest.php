<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeatherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'lat.required' => 'La latitud es obligatoria.',
            'lat.numeric' => 'La latitud debe ser un número.',
            'lon.required' => 'La longitud es obligatoria.',
            'lon.numeric' => 'La longitud debe ser un número.',
        ];
    }
}
