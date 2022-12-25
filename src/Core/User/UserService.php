<?php

/**
 * User service
 */

namespace Core\User;

use Core\User\User;
use Core\User\UserRepository;

class UserService
{
    private UserRepository $userRepository;
    
    public function __construct($userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function add(User $user, string $password)
    {
        $password = hash('sha256', $password);
        $this->userRepository->save($user, $password);
    }

    public function disable(User $user)
    {
        
        $user->disable();
        $this->userRepository->save($user);
    }
}
