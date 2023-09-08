<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Seller;

class SellerRequest extends FormRequest
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
        $sellerId = $this->route('id');

        if ($this->isMethod('post')) {
            return [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Seller::class],
                'commission' => ['required', 'string', 'max:5'],
            ];
        } else {
            return [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('sellers')->ignore($sellerId)],
                'commission' => ['required', 'string', 'max:5'],
            ];
        }
    }

    public function messages()
    {
        return [
            'required' => 'Este campo é obrigatório.',
            'string' => 'Preencha este campo apenas com texto.',
            'max:255' => 'Até 255 caracteres permitidos.',
            'max:5' => 'Até 5 caracteres permitidos.',
            'email' => 'Inclua um @.',
            'unique' => 'Já existe um vendedor cadastrado com este e-mail.'
        ];
    }
}
