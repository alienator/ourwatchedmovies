<?php

/**
 * User repository interface
 */

namespace Core\User;

use Core\User\User;

interface UserRepository
{
    public function save(User $user, string $password = ''): void;
    
    public function findByEmailAndPassword(string $email, string $password);

    public function findById(int $id): User;
}
