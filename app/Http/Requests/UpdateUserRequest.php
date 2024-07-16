<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'filled|required|string|max:255',
            'email' => 'filled|required|string|email|max:255',
            'situacao' => 'filled|integer|digits_between: 0,2',
        ];
    }

    public function messages()
    {
        return [
            'name.filled' => 'Campo Nome precisa ser preenchido',
            'name.required' => 'Campo Nome precisa ser preenchido',
            'name.string' => 'Campo Nome precisa ser texto',
            'name.max:255' => 'Campo Nome precisa ter mais do 255 caracteres',
            'email.filled' => 'Campo E-mail precisa ser preenchido',
            'email.required' => 'Campo E-mail precisa ser preenchido',
            'email.string' => 'Campo E-mail precisa ser texto',
            'email.email' => 'Campo E-mail precisa ser valido',
            'email.unique' => 'Campo E-mail ja existe',
            'situacao.filled' => 'Campo Situacao precisa ser preenchido',
            'situacao.integer' => 'Campo Situacao precisa ser inteiro',
            'situacao.digits_between' => 'Campo Situacao precisa ser 0 e 2',
        ];
    }
}
