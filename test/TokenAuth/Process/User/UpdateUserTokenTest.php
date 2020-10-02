<?php
namespace TokenAuthTest\Process\User;

use TokenAuth\Data\Entity\Token;
use TokenAuth\Data\Repository\RefreshToken\GetRefreshTokenInterface;
use TokenAuth\Data\Repository\User\GetUserInterface;
use TokenAuth\Process\Request\UpdateTokenRequest;
use TokenAuth\Process\Response\GenerateTokenResponse;
use TokenAuth\Process\Token\GenerateTokenInterface;
use TokenAuth\Process\Token\TokenValidatorInterface;
use TokenAuth\Process\User\UpdateUserToken;
use PHPUnit\Framework\TestCase;

class UpdateUserTokenTest extends TestCase
{
    private $refreshTokenRepo;
    private $tokenGenerator;
    private $userRepo;
    private $tokenValidator;
    private $process;

    protected function setUp(): void
    {
        $this->refreshTokenRepo = $this->createMock(GetRefreshTokenInterface::class);
        $this->tokenGenerator = $this->createMock(GenerateTokenInterface::class);
        $this->userRepo = $this->createMock(GetUserInterface::class);
        $this->tokenValidator = $this->createMock(TokenValidatorInterface::class);
        $this->process = new UpdateUserToken(
            $this->refreshTokenRepo,
            $this->tokenGenerator,
            $this->userRepo,
            $this->tokenValidator
        );
    }

    public function testReturnsExpectedResponseIfRefreshTokenNotFound()
    {
        $this->refreshTokenRepo->method('getRefreshTokenForUser')->willreturn(null);
        $updateTokenRequest = new UpdateTokenRequest(1, '123');
        $result = $this->process->updateToken($updateTokenRequest);
        $this->assertEquals(false, $result->getTokenFound());
        $this->assertEquals(false, $result->getTokenExpired());
        $this->assertEquals(false, $result->getUpdated());
    }

    public function testReturnsExpectedResponseIfRefreshTokenInvalid()
    {
        $token = new Token('123', new \DateTime());
        $this->refreshTokenRepo->method('getRefreshTokenForUser')->willreturn($token);
        $this->tokenValidator->method('isValidToken')->willReturn(false);
        $updateTokenRequest = new UpdateTokenRequest(1, '123');
        $result = $this->process->updateToken($updateTokenRequest);
        $this->assertEquals(true, $result->getTokenFound());
        $this->assertEquals(true, $result->getTokenExpired());
        $this->assertEquals(false, $result->getUpdated());
    }

    public function testReturnsExpectedResultIfTokenIncorrect()
    {
        $token = new Token('123', new \DateTime());
        $this->refreshTokenRepo->method('getRefreshTokenForUser')->willreturn($token);
        $this->tokenValidator->method('isValidToken')->willReturn(true);
        $updateTokenRequest = new UpdateTokenRequest(1, '321');
        $result = $this->process->updateToken($updateTokenRequest);
        $this->assertEquals(true, $result->getTokenFound());
        $this->assertEquals(false, $result->getTokenExpired());
        $this->assertEquals(true, $result->getTokenIncorrect());
        $this->assertEquals(false, $result->getUpdated());
    }

    public function testReturnsNewTokenIfRefreshTokenValid()
    {
        $token = new Token('123', new \DateTime());
        $this->refreshTokenRepo->method('getRefreshTokenForUser')->willreturn($token);
        $this->tokenValidator->method('isValidToken')->willReturn(true);
        $updateTokenRequest = new UpdateTokenRequest(1, '123');
        $tokenResponse = new GenerateTokenResponse('3213', new \DateTime());
        $this->tokenGenerator->method('getToken')->willReturn($tokenResponse);
        $result = $this->process->updateToken($updateTokenRequest);

        $this->assertEquals(true, $result->getTokenFound());
        $this->assertEquals(false, $result->getTokenExpired());
        $this->assertEquals(false, $result->getTokenIncorrect());
        $this->assertEquals(true, $result->getUpdated());
        $this->assertEquals('3213', $result->getNewToken());
    }
}
