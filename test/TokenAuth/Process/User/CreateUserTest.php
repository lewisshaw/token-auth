<?php
namespace TokenAuthTest\Process\User;

use TokenAuth\Data\Entity\User;
use TokenAuth\Data\Repository\User\CreateUserInterface;
use TokenAuth\Process\Password\PasswordHasherInterface;
use TokenAuth\Process\Request\CreateUserRequest;
use TokenAuth\Process\Response\CreateUserResponse;
use TokenAuth\Process\User\CreateUser;
use PHPUnit\Framework\TestCase;

class CreateUserTest extends TestCase
{
    private $createUserRepo;
    private $passwordHasher;
    private $createUserProcess;

    protected function setUp(): void
    {
        $this->createUserRepo = $this->createMock(CreateUserInterface::class);
        $this->passwordHasher = $this->createMock(PasswordHasherInterface::class);
        $this->createUserProcess = new CreateUser(
            $this->createUserRepo,
            $this->passwordHasher
        );
    }

    public function testUserCreated()
    {
        $obj_request = new CreateUserRequest('test@test.com', '123', 'Test Name');
        $this->passwordHasher->method('hash')->willReturn('321');
        $user = new User('test@test.com', '321', 'Test Name');
        $user->setUserId(1);
        $this->createUserRepo->method('createUser')->willReturn($user);
        /** @var CreateUserResponse $obj_response */
        $obj_response = $this->createUserProcess->create($obj_request);
        $this->assertEquals('test@test.com', $obj_response->getEmailAddress());
        $this->assertEquals('321', $obj_response->getPassword());
        $this->assertEquals(1, $obj_response->getUserId());
        $this->assertEquals('Test Name', $obj_response->getName());
    }
}
