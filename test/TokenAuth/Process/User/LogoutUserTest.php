<?php
namespace TokenAuthTest\Process\User;

use TokenAuth\Data\Repository\RefreshToken\DeleteRefreshTokenInterface;
use TokenAuth\Process\User\LogoutUser;
use PHPUnit\Framework\TestCase;

class LogoutUserTest extends TestCase
{
    private $refreshTokenRepo;
    private $process;

    protected function setUp(): void
    {
        $this->refreshTokenRepo = $this->createMock(DeleteRefreshTokenInterface::class);
        $this->process = new LogoutUser($this->refreshTokenRepo);
    }

    public function testDeletesRefreshToken()
    {
        $userId = 1;
        $this->refreshTokenRepo->expects($this->once())->method('delete')->with($userId);
        $this->process->logout($userId);
    }
}
