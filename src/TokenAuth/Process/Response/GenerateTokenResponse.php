<?php

namespace TokenAuth\Process\Response;

use DateTimeInterface;

class GenerateTokenResponse
{
    private $token;
    private $expiryDate;

    public function __construct(string $token, DateTimeInterface $expiryDate)
    {
        $this->token = $token;
        $this->expiryDate = $expiryDate;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getExpiryDate()
    {
        return $this->expiryDate;
    }
}
