<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface 
{
    public function getAllUsers() 
    {
        return User::all();
    }

    public function getUserById($userId) 
    {
        return User::findOrFail($userId);
    }

    public function deleteUser($userId) 
    {
        User::destroy($userId);
    }

    public function createUser(array $user) 
    {
        return User::create($user);
    }

    public function updateUser($userId, array $user) 
    {
        return User::whereId($userId)->update($user);
    }

    
}
