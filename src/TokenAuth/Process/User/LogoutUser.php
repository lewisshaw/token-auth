<?php

namespace TokenAuth\Process\User;

use TokenAuth\Data\Repository\RefreshToken\DeleteRefreshTokenInterface;

class LogoutUser
{
    private DeleteRefreshTokenInterface $tokenRepo;

    public function __construct(DeleteRefreshTokenInterface $tokenRepo)
    {
        $this->tokenRepo = $tokenRepo;
    }

    public function logout(int $userId): void
    {
        $this->tokenRepo->delete($userId);
    }
}
