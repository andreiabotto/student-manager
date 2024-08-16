<?php

namespace App\Repositories\Interfaces;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;

interface StudentRepositoryInterface
{
    public function all(?array $params): Collection;

    public function find(int $id): ?Student;

    public function create(array $data): Student;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
