<?php

namespace TokenAuth\Process\Response;

use DateTimeInterface;

class GenerateTokenResponse
{
    private string $token;
    private DateTimeInterface $expiryDate;

    public function __construct(string $token, DateTimeInterface $expiryDate)
    {
        $this->token = $token;
        $this->expiryDate = $expiryDate;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getExpiryDate(): DateTimeInterface
    {
        return $this->expiryDate;
    }
}
