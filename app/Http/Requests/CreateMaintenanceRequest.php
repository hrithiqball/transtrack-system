<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMaintenanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'maintenance_date' => ['date', 'required'],
            'serviced_by' => ['string', 'required'],
            'vehicle_id' => ['numeric', 'required'],
            'remarks' => ['string', 'nullable']
        ];
    }

    public function attributes()
    {
        return [
            'maintenance_date' => 'maintenance_date',
            'serviced_by' => 'serviced_by',
            'vehicle_id' => 'vehicle_id',
            'remarks' => 'remarks'
        ];
    }
}
