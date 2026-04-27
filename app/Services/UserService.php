<?php
namespace App\Services;
use App\Events\UserDeleted;
use App\Events\UserUpdated;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use App\Events\UserCreated;
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
        $user = $this->userRepo->create($data);
        event(new UserCreated($user));
        return $user;
    }

    public function updateUser($data, $user)
    {
        $user = $this->userRepo->update($data, $user);
        event(new UserUpdated($user));
        return $user;
    }
    
          
    public function deleteUser($user)
    {
         $this->userRepo->delete($user);
         event(new UserDeleted($user));
    }


    }