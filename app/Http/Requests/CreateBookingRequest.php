<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest
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
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'vehicle_id' => ['required', 'int'],
            'booked_by' => ['required', 'int'],
            'notes' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function attributes()
    {
        return [
            'start_date' => 'start_date' ?: null,
            'end_date' => 'end_date' ?: null,
            'vehicle_id' => 'vehicle_id',
            'booked_by' => 'booked_by' ?: null,
            'notes' => 'notes' ?: null,
            'status' => 'status' ?: 'Pending',
        ];
    }
}
