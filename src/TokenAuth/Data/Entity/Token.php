<?php

namespace TokenAuth\Data\Entity;

use DateTimeInterface;

class Token
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
