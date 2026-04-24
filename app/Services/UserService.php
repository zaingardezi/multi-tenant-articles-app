<?php
namespace App\Services;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
class UserService
{
    public function __construct(
        protected UserRepositoryInterface $userRepo
    ) {}

    public function getUsers()
    {
        return $this->userRepo->getAllUsers();
    }

    public function createUser($data)
    {
        return $this->userRepo->create($data);
    }

    public function updateUser($data, $user)
    {
        return $this->userRepo->update($data, $user);
    }
}