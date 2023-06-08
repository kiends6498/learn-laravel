<?php

namespace App\Repositories;

use App\Repositories\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function findByEmail($email)
    {
        return $this->userModel->where('email', $email)->first();
        // return User::where('email', $email)->first();
    }

    public function resetPasswordRepo($email, $newPassword)
    {
        $user = $this->findByEmail($email);

        if (!$user)
            return false;

        $user->password = bcrypt($newPassword);
        $user->save();
        return true;
    }

    public function createNewUser($email, $name, $password)
    {
        $user = $this->userModel->create([
            'email' => $email,
            'name' => $name,
            'password' => bcrypt($password),
        ]);

        return $user;
    }
}