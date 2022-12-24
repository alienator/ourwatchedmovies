<?php

/**
 * Auth repositroy interface
 */

namespace Core\Auth;

use Core\User\User;

interface AuthRepository
{
    public function save(User $user, string $token): void;
    public function destroy(string $token): void;
}
