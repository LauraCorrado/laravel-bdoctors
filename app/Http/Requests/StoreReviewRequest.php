<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
            'doctor_id' => 'required|exists:doctors,id',
            'name' => 'nullable|string|max:150',
            'email' => 'required|email|max:150',
            'content' => 'required|string',
            'vote' => 'nullable|integer|between:0,5'
        ];
    }
}
