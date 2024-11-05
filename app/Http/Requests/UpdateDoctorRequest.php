<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
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
            "user_name" => 'required|string|min:2|max:100',
            "user_surname" => 'required|string|min:2|max:100',
            "city" => 'required|string|max:100',
            "address" => 'required|string|min:5|max:150',
            "phone_number" => 'required|string|min:10|max:20',
            'fields' => 'required|array',
            // 'fields.*' => 'exists:fields,id'
            "performance" => 'required|string|min:30',
            "cv" => 'nullable',
            "thumb" => 'nullable',
        ];
    }

  
    public function messages()
    {
        return [
            'user_name.required' => 'Questo campo è obbligatorio.',
            'user_name.min' => 'Il nome deve contenere almeno 2 caratteri.',
            'user_name.max' => 'Il nome può contenere massimo :max caratteri.',
            'user_surname.required' => 'Questo campo è obbligatorio.',
            'user_surname.min' => 'Il cognome deve contenere almeno 2 caratteri.',
            'user_surname.max' => 'Il cognome può contenere massimo :max caratteri.',
            'city.required' => 'Questo campo è obbligatorio.',
            'city.max' => 'La città non può superare i :max caratteri.',
            'address.required' => 'Questo campo è obbligatorio.',
            'address.min' => 'L\'indirizzo deve contenere almeno 5 caratteri.',
            'address.max' => 'L\'indirizzo non può superare i :max caratteri.',
            'phone_number.required' => 'Questo campo è obbligatorio.',
            'phone_number.min' => 'Il numero di telefono deve contenere almeno 10 cifre.',
            'phone_number.max' => 'Il numero di telefono non può essere superiore a :max cifre.',
            'performance.required' => 'Questo campo è obbligatorio.',
            'performance.min' => 'La descrizione delle prestazioni deve contenere almeno 30 caratteri.',
            'fields.required' => 'Seleziona almeno una specializzazione per registrare il tuo profilo.',
        ];
    }
}