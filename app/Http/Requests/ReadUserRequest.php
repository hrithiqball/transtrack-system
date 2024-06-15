<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReadUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'role' => ['string']
        ];
    }
}
