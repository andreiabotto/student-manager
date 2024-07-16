<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Campo Nome precisa ser preenchido',
            'name.string' => 'Campo Nome precisa ser texto',
            'name.max:255' => 'Campo Nome precisa ter mais do 255 caracteres',
            'email.required' => 'Campo E-mail precisa ser preenchido',
            'email.string' => 'Campo E-mail precisa ser texto',
            'email.email' => 'Campo E-mail precisa ser valido',
            'email.unique' => 'Campo E-mail ja existe'
        ];
    }
}
