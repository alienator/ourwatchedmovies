<?php

/**
 * Use service test
 */

declare(strict_types=1);

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
            ->with($user, hash('sha256', $password));

        // When
        $userServiceUnderTest = new UserService($mockUserRepository);
        $userServiceUnderTest->add($user, $password);
    }
}
