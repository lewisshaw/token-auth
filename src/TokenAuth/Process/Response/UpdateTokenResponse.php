<?php

namespace TokenAuth\Process\Response;

use LogicException;

class UpdateTokenResponse
{
    private bool $updated;
    private bool $tokenFound;
    private bool $tokenExpired;
    private ?string $newToken = null;

    public function __construct(bool $updated, bool $tokenFound, bool $tokenExpired, ?string $newToken = null)
    {
        $this->updated = $updated;
        $this->tokenFound = $tokenFound;
        $this->tokenExpired = $tokenExpired;
        $this->newToken = $newToken;
    }

    public function getUpdated(): bool
    {
        return $this->updated;
    }

    public function getTokenFound(): bool
    {
        return $this->tokenFound;
    }

    public function getTokenExpired(): bool
    {
        return $this->tokenExpired;
    }

    public function getNewToken(): string
    {
        if (null === $this->newToken) {
            throw new LogicException('Cannot get token when it has not been set');
        }
        return $this->newToken;
    }
}
