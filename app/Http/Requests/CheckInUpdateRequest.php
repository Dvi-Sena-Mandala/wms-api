<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;


class CheckInUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'no_document' => 'nullable|string|max:20',
            'kuantum' => 'nullable|numeric',
            'driver_name' => 'nullable|string|max:50',
            'vehicle_plat' => 'nullable|string|max:10',
            'container_number' => 'nullable|string|max:20',
            'document_type' => 'nullable|string|max:3',
            'image_identity_card' => 'nullable|image',
            'image_front_truck' => 'nullable|image',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            "errors" => $validator->getMessageBag()
        ], 400));
    }
}
