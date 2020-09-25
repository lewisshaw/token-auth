<?php
namespace TokenAuthTest\Process\User;

use TokenAuth\Data\Entity\User;
use TokenAuth\Data\Repository\User\UserInterface;
use TokenAuth\Process\Password\PasswordHasherInterface;
use TokenAuth\Process\Request\UpdateUserPasswordRequest;
use TokenAuth\Process\User\UpdateUserPassword;
use PHPUnit\Framework\TestCase;

class UpdateUserPasswordTest extends TestCase
{
    private $userRepo;
    private $passwordHasher;

    protected function setUp(): void
    {
        $this->userRepo = $this->createMock(UserInterface::class);
        $this->passwordHasher = $this->createMock(PasswordHasherInterface::class);
        $this->process = new UpdateUserPassword(
            $this->userRepo,
            $this->passwordHasher
        );
    }

    public function testReturnsExpectedResponseIfOldPasswordDoesNotMatch()
    {
        $user = new User(
            'test@test.com',
            '123',
            'Test Name'
        );
        $this->userRepo->method('getUserById')->willReturn($user);
        $this->passwordHasher->method('hash')->willReturn('321');
        $updatePasswordRequest = new UpdateUserPasswordRequest(
            1,
            '333',
            '444'
        );
        $result = $this->process->updatePassword($updatePasswordRequest);
        $this->assertEquals(false, $result->getOldPasswordMatch());
        $this->assertEquals(false, $result->getUpdated());
    }

    public function testPasswordUpdatedIfPasswordsMatch()
    {
        $user = new User(
            'test@test.com',
            '123',
            'Test Name'
        );
        $this->userRepo->method('getUserById')->willReturn($user);
        $this->passwordHasher->method('hash')
            ->willReturnOnConsecutiveCalls('123', '545');
        $updatePasswordRequest = new UpdateUserPasswordRequest(
            1,
            '321',
            '444'
        );
        $result = $this->process->updatePassword($updatePasswordRequest);
        $this->assertEquals(true, $result->getOldPasswordMatch());
        $this->assertEquals(true, $result->getUpdated());
    }
}
