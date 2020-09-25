<?php

namespace TokenAuth\Process\User;

use TokenAuth\Data\Repository\RefreshToken\DeleteRefreshTokenInterface;

class LogoutUser
{
    private $tokenRepo;

    public function __construct(DeleteRefreshTokenInterface $tokenRepo)
    {
        $this->tokenRepo = $tokenRepo;
    }

    public function logout(int $userId)
    {
        $this->tokenRepo->delete($userId);
    }
}
