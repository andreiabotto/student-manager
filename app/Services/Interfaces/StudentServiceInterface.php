<?php

namespace App\Services\Interfaces;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;

interface StudentServiceInterface
{
    public function getAllStudents(): Collection;

    public function getStudentById(int $id): ?Student;

    public function createStudent(array $data): Student;

    public function updateStudent(int $id, array $data): bool;

    public function deleteStudent(int $id): bool;
}
