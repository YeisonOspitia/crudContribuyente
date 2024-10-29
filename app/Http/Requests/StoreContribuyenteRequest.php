<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContribuyenteRequest extends FormRequest
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
            'tipo_documento' => 'required|string|max:20',
            'documento' => 'required|string|min:5',
            'nombres' => 'nullable|string|max:100',
            'apellidos' => 'nullable|string|max:100',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'celular' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',            
            'razon_social' => 'nullable|string|max:255|required_if:tipo_documento,NIT', // Validación condicional
        ];
    }
}
