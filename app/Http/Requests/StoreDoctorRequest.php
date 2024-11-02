<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "user_name" => 'required|string|max:150',
            "user_surname" => 'required|string|max:150',
            "city" => 'required|string|max:150',
            "address" => 'required|string|max:150',
            "phone_number" => 'required|string|max:20',
            'fields' => 'required|array',
            // 'fields.*' => 'exists:fields,id'
            "performance" => 'required|string',
            "cv" => 'nullable|string',
            "thumb" => 'nullable|string',
        ];
    }
}
