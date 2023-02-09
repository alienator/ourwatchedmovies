<?php

/**
 * Use service test
 */

declare(strict_types=1);

use Core\Crypto\Crypto;
use PHPUnit\Framework\TestCase;

use Core\User\User;
use Core\User\UserRepository;
use Core\User\UserService;

final class UserServiceTest extends TestCase
{
    public function test_it_suhould_register_a_user()
    {
        // Given
        $user = new User(0, 'name', 'email', 'image_path');
        $password = '123';

        // Expect
        $mockUserRepository = $this->getMockBuilder(UserRepository::class)
            ->getMock();

        $mockUserRepository->expects($this->once())
            ->method('save')
            ->with($user, 'ABCD1234');

        $mockCrypto = $this->getMockBuilder(Crypto::class)
            ->getMock();
        $mockCrypto->expects($this->once())
            ->method('hash')
            ->willReturn('ABCD1234');

        // When
        $userServiceUnderTest = new UserService(
            $mockUserRepository,
            $mockCrypto
        );
        $userServiceUnderTest->save($user, $password);
    }

    public function test_it_should_disable_a_user(): void
    {
        // Given
        $user = new User(1, 'name', 'some@email.com');

        // Expect
        $mockUserRepository = $this->getMockBuilder(UserRepository::class)
            ->getMock();

        $mockUserRepository->expects($this->once())
            ->method('save')
            ->with($user);

        $mockCrypto = $this->getMockBuilder(Crypto::class)
            ->getMock();

        // When
        $userService = new UserService($mockUserRepository, $mockCrypto);
        $userService->disable($user);

        // Then
        $this->assertTrue($user->isDisable());
    }
}
