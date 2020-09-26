<?php

namespace TokenAuth\Process\Response;

use LogicException;

class LoginUserResponse
{
    private bool $isLoginValid;
    private ?string $token = null;

    public function __construct(bool $isLoginValid, ?string $token = null)
    {
        $this->isLoginValid = $isLoginValid;
        $this->token = $token;
    }

    public function isLoginValid(): bool
    {
        return $this->isLoginValid;
    }

    public function getToken(): string
    {
        if (null === $this->token) {
            throw new LogicException('Cannot get token when it is not set');
        }
        return $this->token;
    }
}
