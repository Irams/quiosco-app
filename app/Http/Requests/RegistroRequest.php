<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password as PasswordRules;

class RegistroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    // Reglas de validación:
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                PasswordRules::min(8)->letters()->symbols()->numbers(),
            ]
        ];
    }
    
    // Personalizamos los mensajes en español:
    public function messages()
    {
        return[
            'name'              => 'El nombre es obligatorio',
            'email.required'    => 'El email es obligatorio',
            'email.email'       => 'El email no es válido',
            'email.unique'      => 'El usuario ya está registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.confirmed'=> 'Las contraseñas deben de ser iguales',
            'password'          => 'El password debe contener al menos 8 caracteres, un símbolo y un número'    
        ];
    }
}
