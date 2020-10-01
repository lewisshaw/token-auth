<?php
namespace TokenAuthTest\Process\User;

use TokenAuth\Data\Entity\Token;
use TokenAuth\Data\Entity\User;
use TokenAuth\Data\Repository\User\GetUserInterface;
use TokenAuth\Process\Password\PasswordHasherInterface;
use TokenAuth\Process\Request\LoginUserRequest;
use TokenAuth\Process\Response\GenerateTokenResponse;
use TokenAuth\Process\Token\GenerateTokenInterface;
use TokenAuth\Process\User\LoginUser;
use PHPUnit\Framework\TestCase;
use TokenAuth\Process\Password\PasswordVerifierInterface;

class LoginUserTest extends TestCase
{
    private $getUserRepo;
    private $tokenGenerator;
    private $passwordVerifier;
    private $process;

    protected function setUp(): void
    {
        $this->getUserRepo = $this->createMock(GetUserInterface::class);
        $this->tokenGenerator = $this->createMock(GenerateTokenInterface::class);
        $this->passwordVerifier = $this->createMock(PasswordVerifierInterface::class);
        $this->process = new LoginUser(
            $this->tokenGenerator,
            $this->getUserRepo,
            $this->passwordVerifier
        );
    }

    public function testLoginFailsIfUserNotFound()
    {
        $this->getUserRepo->method('getUserByEmail')->willReturn(null);
        $loginRequest = new LoginUserRequest('test@test.com', '123');
        $obj_response = $this->process->login($loginRequest);
        $this->assertEquals(false, $obj_response->isLoginValid());
    }

    public function testLoginFailsIfPasswordIncorrect()
    {
        $user = new User('test@test.com', '321', 'Test Name');
        $this->getUserRepo->method('getUserByEmail')->willReturn($user);
        $this->passwordVerifier->method('isPasswordCorrect')->willReturn(false);
        $loginRequest = new LoginUserRequest('test@test.com', '123');
        $obj_response = $this->process->login($loginRequest);
        $this->assertEquals(false, $obj_response->isLoginValid());
    }

    public function testLoginSuceedsIfPasswordMatches()
    {
        $user = new User('test@test.com', '321', 'Test Name');
        $this->getUserRepo->method('getUserByEmail')->willReturn($user);
        $this->passwordVerifier->method('isPasswordCorrect')->willReturn(true);
        $tokenResponse = new GenerateTokenResponse('hg54', new \DateTime());
        $this->tokenGenerator->method('getToken')->willReturn($tokenResponse);
        $loginRequest = new LoginUserRequest('test@test.com', '432');
        $obj_response = $this->process->login($loginRequest);
        $this->assertEquals(true, $obj_response->isLoginValid());
        $this->assertEquals('hg54', $obj_response->getToken());
    }
}
