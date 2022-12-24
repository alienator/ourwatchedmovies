<?php

/**
 * Auth Service test
 */

use Core\Auth\AuthService;
use Core\User\User;
use Core\User\UserRepository;
use PHPUnit\Framework\TestCase;
use Core\Net\NetClient;
use Core\Auth\AuthRepository;

final class AuthServiceTest extends TestCase
{
    private $mockUserRepository;
    private $mockNetClient;
    private $mockAuthRepository;

    public function setUp(): void
    {
        $this->mockUserRepository = $this->getMockBuilder(UserRepository::class)
            ->getMock();

        $this->mockNetClient = $this->getMockBuilder(NetClient::class)
            ->getMock();

        $this->mockAuthRepository = $this->getMockBuilder(AuthRepository::class)
            ->getMock();
    }

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
        $this->mockUserRepository->expects($this->once())
            ->method('findByEmailAndPassword')
            ->with($email, $pass)
            ->willReturn($user);

        $this->mockNetClient->expects($this->once())
            ->method('getIP')
            ->willReturn($ip);
        $this->mockNetClient->expects($this->once())
            ->method('getUserAgent')
            ->willReturn($userAgent);


        $this->mockAuthRepository->expects($this->once())
            ->method('save')
            ->with($user, $expected);

        // When
        $authService = new AuthService(
            $this->mockUserRepository,
            $this->mockNetClient,
            $this->mockAuthRepository
        );

        $actual      = $authService->login($email, $pass, $dateTime);

        // Then
        $this->assertEquals($expected, $actual);
    }

    public function test_a_user_con_logout()
    {
        // Given
        $token = 'ABCD123';

        // Expect
        $this->mockAuthRepository->expects($this->once())
            ->method('destroy')
            ->with($token);

        // When
        $authService = new AuthService(
            $this->mockUserRepository,
            $this->mockNetClient,
            $this->mockAuthRepository
        );

        $actual = $authService->logout($token);

        // Then
        $this->assertTrue($actual);
    }
}
