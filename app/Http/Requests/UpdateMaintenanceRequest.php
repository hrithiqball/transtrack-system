<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaintenanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'completed' => ['boolean'],
        ];
    }

    public function attributes()
    {
        return [
            'completed' => 'completed',
        ];
    }
}
