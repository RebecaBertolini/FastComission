<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'sale_price' => ['required', 'numeric', 'max:9999999.99'],
            'sale_date' => ['required', 'date']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Este campo é obrigatório',
            'numeric' => 'Apenas números permitidos',
            'date' => 'Este campo precisa ser no formato de data.',
            'max' => 'O campo deve ter até 9999999.99 e ser maior que 0.'
        ];
    }
}
