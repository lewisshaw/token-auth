<?php

namespace TokenAuth\Process\Request;

class GenerateTokenRequest
{
    private string $email;
    private array $extraTokenData;

    public function __construct(string $email, array $extraTokenData)
    {
        $this->email = $email;
        $this->extraTokenData = $extraTokenData;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getExtraTokenData(): array
    {
        return $this->extraTokenData;
    }
}
