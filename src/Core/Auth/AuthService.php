<?php

/**
 * Auth service
 */

namespace Core\Auth;

use Core\User\UserRepository;
use Core\Net\NetClient;

class AuthService
{
    private UserRepository $userRepository;
    private NetClient $netClient;

    public function __construct($userRepository, $netClient)
    {
        $this->userRepository = $userRepository;
        $this->netClient = $netClient;
    }

    public function login(string $email, string $password, string $dateTime)
    {
        $user = $this->userRepository->findByEmailAndPassword(
            $email,
            $password
        );

        if ($user !== NULL) {
            $text  = $user->getId() . '+' . $this->netClient->getIp() . '+' .
                   $this->netClient->getUserAgent() . '+' . $dateTime;
            
            $token = hash('sha256', $text);
            return $token;
        }
        else
            return '';
    }
}
