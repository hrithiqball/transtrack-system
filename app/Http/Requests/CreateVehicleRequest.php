<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVehicleRequest extends FormRequest
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
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['nullable', 'string', 'max:255'],
            'plate_number' => ['nullable', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'int'],
            'status' => ['nullable', 'string', 'max:255'],
            'latitude' => ['nullable', 'regex:/^[-]?([0-8]?[0-9]|90)\.[0-9]{1,6}$/'],
            'longitude' => ['nullable', 'regex:/^[-]?((1[0-7][0-9])|([0-9]?[0-9]))\.[0-9]{1,6}$/'],
            'photo' => ['nullable', 'image', 'max:2048']
        ];
    }

    protected function handlePhotoUpload(): array
    {
        $data = $this->validated();

        if ($this->hasFile('photo')) {
            $photoPath = $this->file('photo')->store('public/vehicles');
            $data['photo'] = str_replace('public/', '', $photoPath);
        }

        return $data;
    }

    public function validatedWithPhoto(): array
    {
        return $this->handlePhotoUpload();
    }
}
