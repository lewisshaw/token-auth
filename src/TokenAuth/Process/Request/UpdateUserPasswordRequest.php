<?php

namespace TokenAuth\Process\Request;

class UpdateUserPasswordRequest
{
    private string $oldRawPassword;
    private string $newRawPassword;
    private int $userId;

    public function __construct(
        int $userId,
        string $oldRawPassword,
        string $newRawPassword
    ) {
        $this->oldRawPassword = $oldRawPassword;
        $this->newRawPassword = $newRawPassword;
        $this->userId = $userId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getOldRawPassword(): string
    {
        return $this->oldRawPassword;
    }

    public function getNewRawPassword(): string
    {
        return $this->newRawPassword;
    }
}
