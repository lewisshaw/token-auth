<?php

namespace TokenAuth\Process\Request;

class UpdateTokenRequest
{
    private int $userId;
    private string $refreshToken;

    public function __construct(int $userId, string $refreshToken)
    {
        $this->userId = $userId;
        $this->refreshToken = $refreshToken;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }
}
