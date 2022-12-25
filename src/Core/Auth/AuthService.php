<?php

/**
 * Auth service
 */

namespace Core\Auth;

use Core\User\UserRepository;
use Core\Net\NetClient;
use Core\Auth\AuthRepository;
use Exception;
use Core\Crypto\Crypto;

class AuthService
{
    private UserRepository $userRepository;
    private NetClient $netClient;
    private AuthRepository $authRepository;
    private Crypto $crypto;

    public function __construct(
        $userRepository,
        $netClient,
        $authRepository,
        $crypto
    ) {
        $this->userRepository = $userRepository;
        $this->netClient      = $netClient;
        $this->authRepository = $authRepository;
        $this->crypto         = $crypto;
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

            $token = $this->crypto->hash($text);

            $this->authRepository->save($user, $token);

            return $token;
        } else
            return '';
    }

    public function logout(string $token): bool
    {
        try {
            $this->authRepository->destroy($token);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }
}
