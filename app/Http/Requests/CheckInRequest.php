<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckInRequest extends FormRequest
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
            'no_document' => 'max:20',
            'kuantum' => 'required|max:20',
            'driver_name' => 'required|max:50',
            'vehicle_plat' => 'required|max:10',
            'container_number' => 'max:20',
            'document_type' => 'max:3',
            'image_identity_card' => 'required|image',
            'image_front_truck' => 'required|image',
        ];
    }
}
