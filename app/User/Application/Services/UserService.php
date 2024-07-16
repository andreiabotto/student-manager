<?php

namespace App\User\Application\Services;

use App\User\Repositories\Interfaces\UserRepositoryInterface;
use App\User\Application\Services\Interfaces\UserServiceInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(?array $params = []): Collection
    {
        return $this->userRepository->all($params);
    }

    public function getUserById(int $id): ?User
    {
        return $this->userRepository->find($id);
    }

    public function createUser(array $data): User
    {
        $data['situacao'] = 0;
        $data['admission_date'] = Carbon::now();

        return $this->userRepository->create($data);
    }

    public function updateUser(int $id, array $data): bool
    {
        return $this->userRepository->update($id, $data);
    }

    public function deleteUser(int $id): bool
    {
        return $this->userRepository->delete($id);
    }
}
