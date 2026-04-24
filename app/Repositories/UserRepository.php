<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(array $data, $user)
    {
        $user->update($data);
        return $user;
    }

    public function delete($user)
    {
        return $user->delete();
    }
}