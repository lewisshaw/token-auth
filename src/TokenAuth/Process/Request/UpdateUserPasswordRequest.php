<?php

namespace TokenAuth\Process\Request;

class UpdateUserPasswordRequest
{
    private $oldRawPassword;
    private $newRawPassword;
    private $userId;

    public function __construct(
        int $userId,
        string $oldRawPassword,
        string $newRawPassword
    ) {
        $this->oldRawPassword = $oldRawPassword;
        $this->newRawPassword = $newRawPassword;
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getOldRawPassword()
    {
        return $this->oldRawPassword;
    }

    public function getNewRawPassword()
    {
        return $this->newRawPassword;
    }
}
