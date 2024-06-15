<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMaintenanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'maintenance_date' => ['required', 'date'],
            'serviced_by' => ['required', 'string'],
            'vehicle_id' => ['required', 'int'],
            'remarks' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function attributes()
    {
        return [
            'maintenance_date' => 'maintenance_date' ?: null,
            'serviced_by' => 'serviced_by',
            'vehicle_id' => 'vehicle_id',
            'remarks' => 'remarks' ?: null,
        ];
    }
}
