<?php

/**
 * User service
 */

namespace Core\User;

use Core\User\User;
use Core\User\UserRepository;
use Core\Crypto\Crypto;
    
class UserService
{
    private UserRepository $userRepository;
    private Crypto $crypto;
    
    public function __construct($userRepository, $crypto)
    {
        $this->userRepository = $userRepository;
        $this->crypto         = $crypto;
    }

    public function add(User $user, string $password)
    {
        $password = $this->crypto->hash($password);
        $this->userRepository->save($user, $password);
    }

    public function disable(User $user)
    {
        
        $user->disable();
        $this->userRepository->save($user);
    }
}
