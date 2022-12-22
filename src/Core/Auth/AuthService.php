<?php

/**
 * Auth service
 */

namespace Core\Auth;

use Core\User\UserRepository;

class AuthService
{
    private UserRepository $userRepository;

    public function __construct($userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(string $userEmail, string $userPassword)
    {
        $userPassword = hash('sha256', $userPassword);        
        $user =  $this->userRepository->findByEmailAndPassword(
            $userEmail,
            $userPassword
        );

        if ($user !== null) {
            //TODO: create token nto session
        }

        return $user;
    }
}
