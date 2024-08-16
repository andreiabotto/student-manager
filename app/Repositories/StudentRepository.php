<?php

namespace App\Repositories;

use App\Models\Student;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class StudentRepository implements StudentRepositoryInterface
{
    public function all(?array $params = []): Collection
    {
        if ($params) {
            return Student::where($params[0], 'LIKE', '%'.$params[1].'%')->get();
        }

        return Student::all();
    }

    public function find(int $id): ?Student
    {
        return Student::find($id);
    }

    public function create(array $data): Student
    {
        return Student::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $user = $this->find($id);

        if ($user) {
            return $user->update($data);
        }

        return false;
    }

    public function delete(int $id): bool
    {
        $user = $this->find($id);

        if ($user) {
            return $user->delete();
        }

        return false;
    }
}
