<?php

/**
 * Auth service
 */

namespace Core\Auth;

use Core\User\UserRepository;
use Core\Auth\SessionHelper;

class AuthService
{
    private UserRepository $userRepository;
    private SessionHelper $sessionHelper;

    public function __construct($userRepository, $sessionHelper)
    {
        $this->userRepository = $userRepository;
        $this->sessionHelper = $sessionHelper;
    }

    public function login(string $userEmail, string $userPassword)
    {
        $userPassword = hash('sha256', $userPassword);        
        $user =  $this->userRepository->findByEmailAndPassword(
            $userEmail,
            $userPassword
        );

        if ($user !== null) {
            $txt  = $user->getId();
            $txt .= '+' . $user->getEmail();
            $txt .= '+user-agent'; //TODO: Core\Net\RawPHPClient->getUserAgent()
            $txt .= '+IP'; //TODO: Core\Net\RawPHPClient->getUserIp()
            $txt .= '+2022-02-02 02:02:05'; //TODO Core\System\DateTime->getDateTime();
            
            $this->sessionHelper->createToken($txt);
        }

        return $user;
    }
}
