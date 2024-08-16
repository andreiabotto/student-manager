<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'filled|required|string|max:255',
            'age' => 'filled|required|integer|min:18|max:120',
            'grade_first_semester' => 'filled|required|integer|min:0|max:10',
            'grade_second_semester' => 'filled|required|integer|min:0|max:10',
            'teacher_id' => 'filled|required|exists:teachers,id',
            'classroom_id' => 'filled|required|exists:classrooms,id',
        ];
    }

    public function messages()
    {
        return [
            'name.filled' => 'Campo Nome precisa ser preenchido',
            'name.required' => 'Campo Nome precisa ser preenchido',
            'name.string' => 'Campo Nome precisa ser texto',
            'name.max:255' => 'Campo Nome precisa ter mais do 255 caracteres',
            'age.filled' => 'The age field is required.',
            'age.required' => 'The age field is required.',
            'age.integer' => 'The age must be an integer.',
            'age.min' => 'A idade deve ser maior que 18 anos.',
            'age.max' => 'A idade deve ser menor que 120 anos.',
            'classroom_id.filled' => 'O campo classroom_id field é obrigatório.',
            'classroom_id.required' => 'O campo classroom_id field é obrigatório.',
            'classroom_id.exists' => 'O número da sala não existe.',
            'teacher_id.filled' => 'O campo teacher_id é obrigatório.',
            'teacher_id.required' => 'O campo teacher_id é obrigatório.',
            'teacher_id.exists' => 'O professor escolhido não existe.',
        ];
    }
}
