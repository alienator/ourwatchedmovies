<?php

/**
 * Auth Service test
 */

use PHPUnit\Framework\TestCase;

use Core\User\User;
use Core\User\UserRepository;
use Core\Auth\AuthService;

final class AuthTest extends TestCase
{
    public function test_a_user_can_login()
    {
        // Given
        $userEmail = 'user@email.com';
        $userPass  = '123';
        $expected  = new User(1, 'some user', $userEmail);

        // Expect
        $mockUserRepository = $this->getMockBuilder(UserRepository::class)
            ->getMock();

        $mockUserRepository->expects($this->once())
            ->method('findByEmailAndPassword')
            ->with($userEmail, hash('sha256', $userPass))
            ->willReturn($expected);

        // When
        $serviceUnderTest = new AuthService($mockUserRepository);
        $actual           = $serviceUnderTest->login($userEmail, $userPass);

        // Then
        $this->assertEquals($expected, $actual);
    }

    public function test_it_should_not_login_with_worng_data()
    {
        // Given
        $userEmail = 'user@email.com';
        $userPass  = 'wrong password';
        $expected  = new User(1, 'some user', $userEmail);

        // Expect
        $mockUserRepository = $this->getMockBuilder(UserRepository::class)
            ->getMock();

        $mockUserRepository->expects($this->once())
            ->method('findByEmailAndPassword')
            ->with($userEmail, hash('sha256', $userPass))
            ->willReturn(NULL);

        // When
        $serviceUnderTest = new AuthService($mockUserRepository);
        $actual           = $serviceUnderTest->login($userEmail, $userPass);

        // Then
        $this->assertNotEquals($expected, $actual);
    }
}
