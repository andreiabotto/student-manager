<?php

namespace App\Http\Responses;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'age' => $this->age,
            'grade_first_semester' => $this->grade_first_semester,
            'grade_second_semester' => $this->grade_second_semester,
            'teacher_name' => $this->teacher->name,
            'number_classroom' => $this->classroom->number,
            'created_at' => $this->created_at->format('d/m/Y H:i:s'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i:s'),
        ];
    }
}
