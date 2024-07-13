<?php

namespace App\User\Application\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

interface UserServiceInterface
{
    public function getAllUsers(): Collection;

    public function getUserById(int $id): ?User;

    public function createUser(array $data): User;

    public function updateUser(int $id, array $data): bool;

    public function deleteUser(int $id): bool;
}
