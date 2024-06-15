<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {

        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'role' => ['required', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'role' => 'role'
        ];
    }
}
