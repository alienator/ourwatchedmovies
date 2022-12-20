<?php

/**
 * User repository interface
 */

namespace Core\User;

use Core\User\User;

interface UserRepository
{
    public function save(User $user, string $password = ''): void;
}
