<?php

namespace App\Services;

use App\Models\Student;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Services\Interfaces\StudentServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class StudentService implements StudentServiceInterface
{
    protected $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function getAllStudents(?array $params = []): Collection
    {
        return $this->studentRepository->all($params);
    }

    public function getStudentById(int $id): ?Student
    {
        return $this->studentRepository->find($id);
    }

    public function createStudent(array $data): Student
    {
        return $this->studentRepository->create($data);
    }

    public function updateStudent(int $id, array $data): bool
    {
        return $this->studentRepository->update($id, $data);
    }

    public function deleteStudent(int $id): bool
    {
        return $this->studentRepository->delete($id);
    }
}
