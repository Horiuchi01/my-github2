<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "city" => "required|max:100",
            "latitude" => "required|numeric|between:-90,90",
            "longitude" => "required|numeric|between:-180,180"
        ];
    }

    public function city(): string
    {
        return $this->input("city");
    }
    public function latitude(): float
    {
        return $this->input("latitude");
    }
    public function longitude(): float
    {
        return $this->input("longitude");
    }
}
