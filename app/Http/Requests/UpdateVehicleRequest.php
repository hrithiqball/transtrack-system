<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'plate_number' => ['string', 'max:32'],
            'color' => ['string', 'max:255'],
            'status' => ['string', 'max:255'],
            'latitude' => ['numeric'],
            'longitude' => ['numeric'],
        ];
    }

    public function attributes()
    {
        return [
            'plate_number' => 'plate_number',
            'color' => 'color',
            'status' => 'status',
            'latitude' => 'latitude',
            'longitude' => 'longitude',
        ];
    }
}
