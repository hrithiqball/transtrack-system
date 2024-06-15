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
            'plate_number' => ['string', 'max:12'],
        ];
    }

    public function attributes()
    {
        return [
            'plate_number' => 'plate_number',
        ];
    }
}
