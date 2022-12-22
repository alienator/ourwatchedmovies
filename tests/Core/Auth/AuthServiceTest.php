<?php

/**
 * Auth Service test
 */

use PHPUnit\Framework\TestCase;

use Core\User\User;
use Core\User\UserRepository;

use Core\Auth\AuthService;
use Core\Auth\SessionHelper;

final class AuthServiceTest extends TestCase
{
    public function test_a_user_can_login()
    {
        // Given
        $userEmail     = 'user@email.com';
        $userPass      = '123';
        $expected      = new User(1, 'some user', $userEmail);
        $token         = '1+user@email.com+user-agent+IP+2022-02-02 02:02:05';
        $tokenExpected = hash('sha512', $token);

        // Expect
        $mockSessionHelper = $this->getMockBuilder(SessionHelper::class)
            ->getMock();

        $mockSessionHelper->expects($this->once())
            ->method('createToken')
            ->with($token)
            ->willReturn($tokenExpected);

        $mockUserRepository = $this->getMockBuilder(UserRepository::class)
            ->getMock();

        $mockUserRepository->expects($this->once())
            ->method('findByEmailAndPassword')
            ->with($userEmail, hash('sha256', $userPass))
            ->willReturn($expected);

        // When
        $serviceUnderTest = new AuthService(
            $mockUserRepository,
            $mockSessionHelper
        );
        $actual           = $serviceUnderTest->login($userEmail, $userPass);

        // Then
        $this->assertEquals($expected, $actual);
        //$this->assertEquals($tokenExpected, $actualToken);
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

        $mockSessionHelper = $this->getMockBuilder(SessionHelper::class)
            ->getMock();

        $mockSessionHelper->expects($this->never())
                          ->method('createToken');
        
        // When
        $serviceUnderTest = new AuthService(
            $mockUserRepository,
            $mockSessionHelper
        );
        
        $actual           = $serviceUnderTest->login($userEmail, $userPass);

        // Then
        $this->assertNotEquals($expected, $actual);
    }
}
