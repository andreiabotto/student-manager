<?php

namespace App\User\Infrastructure\Adapter\Http\Requests;

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
            'email' => 'filled|required|string|email|max:255|unique:users,email',
            'situacao' => 'filled|integer|digits_between: 0,2',
        ];
    }
}
