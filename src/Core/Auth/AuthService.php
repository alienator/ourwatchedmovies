<?php

/**
 * Auth service
 */

namespace Core\Auth;

use Core\User\UserRepository;
use Core\Net\NetClient;
use Core\Auth\AuthRepository;
use Exception;

class AuthService
{
    private UserRepository $userRepository;
    private NetClient $netClient;
    private AuthRepository $authRepository;

    public function __construct($userRepository, $netClient, $authRepository)
    {
        $this->userRepository = $userRepository;
        $this->netClient = $netClient;
        $this->authRepository = $authRepository;
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

            $this->authRepository->save($user, $token);
            
            return $token;
        }
        else
            return '';
    }

    public function logout(string $token): bool
    {
        try {
            $this->authRepository->destroy($token);
        } catch(Exception $e) {
            return false;
        }

        return true;
    }
}
