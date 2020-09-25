<?php

namespace TokenAuth\Process\Request;

class UpdateTokenRequest
{
    private $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }
}
