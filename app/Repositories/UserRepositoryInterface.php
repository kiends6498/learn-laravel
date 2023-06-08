<?php

namespace App\Repositories;


interface UserRepositoryInterface
{
    public function findByEmail($email);
    public function resetPasswordRepo($email, $newPassword);
    public function createNewUser($email, $name, $password);

}