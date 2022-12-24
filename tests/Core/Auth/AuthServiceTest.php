<?php

/**
 * Auth Service test
 */

use Core\Auth\AuthService;
use Core\User\User;
use Core\User\UserRepository;
use PHPUnit\Framework\TestCase;
use Core\Net\NetClient;

final class AuthServiceTest extends TestCase
{
    public function test_a_user_can_login()
    {
        // Given
        $dateTime  = '2022-02-02 05:05:02';
        $ip        = '192.168.1.1';
        $userAgent = 'test/agent.com';

        $email    = 'some@email.com';
        $pass     = '123';
        $expected = 'ABCD123';
        $user     = new User(1, 'user name', $email);

        $expected = hash('sha256', $user->getId() . '+' . $ip . '+' .
            $userAgent . '+' . $dateTime);
        
        // Expect
        $mockUserRepository = $this->getMockBuilder(UserRepository::class)
            ->getMock();
        $mockUserRepository->expects($this->once())
            ->method('findByEmailAndPassword')
            ->with($email, $pass)
            ->willReturn($user);

        $mockNetClient = $this->getMockBuilder(NetClient::class)
            ->getMock();
        $mockNetClient->expects($this->once())
            ->method('getIP')
            ->willReturn($ip);
        $mockNetClient->expects($this->once())
            ->method('getUserAgent')
            ->willReturn($userAgent);

        // When
        $authService = new AuthService($mockUserRepository, $mockNetClient);
        $actual      = $authService->login($email, $pass, $dateTime);

        // Then
        $this->assertEquals($expected, $actual);
    }
}
