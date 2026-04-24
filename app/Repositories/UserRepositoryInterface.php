<?php
namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getAllUsers();

    public function create(array $data);

    public function update(array $data, $user);

    public function delete($user);
}