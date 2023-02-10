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
use PHPUnit\Framework\MockObject\MockObject;

final class UserServiceTest extends TestCase
{
    /**
     * @var UserRepository&MockObject
     */
    private MockObject $mockRepository;

    /**
     * @var Crypto&MockObject
     */
    private MockObject $mockCrypto;

    private UserService $serviceUnderTest;

    public function setup(): void
    {
        $this->mockCrypto = $this->createMock(Crypto::class);
        $this->mockRepository = $this->createMock(UserRepository::class);
        $this->serviceUnderTest = new UserService($this->mockRepository, $this->mockCrypto);
    }

    public function test_it_suhould_save_a_user()
    {
        // Given
        $user = new User(0, 'name', 'email', 'image_path');
        $password = '123';

        // Expect
        $this->mockRepository->expects($this->once())
            ->method('save')
            ->with($user, 'ABCD1234');

        $this->mockCrypto->expects($this->once())
            ->method('hash')
            ->willReturn('ABCD1234');

        // When
        $this->serviceUnderTest->save($user, $password);
    }

    public function test_it_should_disable_a_user(): void
    {
        // Given
        $user = new User(1, 'name', 'some@email.com');

        // Expect
        $this->mockRepository->expects($this->once())
            ->method('save')
            ->with($user);

        // When
        $this->serviceUnderTest->disable($user);

        // Then
        $this->assertTrue($user->isDisable());
    }

    public function test_it_should_find_a_user_by_id()
    {
        // Given
        $expected = new User(1, 'test', 'test@test.com');
        $id = 1;

        $this->mockRepository->expects($this->once())
            ->method('findById')
            ->with($id)
            ->willReturn($expected);

        // When
        $actual = $this->serviceUnderTest->findById($id);

        // Then
        $this->assertEquals($expected, $actual);
    }
}
