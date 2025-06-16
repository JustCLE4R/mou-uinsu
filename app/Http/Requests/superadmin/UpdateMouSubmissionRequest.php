<?php

namespace App\Http\Requests\superadmin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMouSubmissionRequest extends FormRequest
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
            'status' => 'required|in:pending,review,approved,rejected',
            'status_message' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
            'status_message.string' => 'Pesan status harus berupa teks.',
            'status_message.max' => 'Pesan status maksimal 255 karakter.',
        ];
    }
}
