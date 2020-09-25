<?php

namespace TokenAuth\Process\Response;

class UpdateTokenResponse
{
    private $updated;
    private $tokenFound;
    private $tokenExpired;
    private $newToken;

    public function __construct(bool $updated, bool $tokenFound, bool $tokenExpired, string $newToken = null)
    {
        $this->updated = $updated;
        $this->tokenFound = $tokenFound;
        $this->tokenExpired = $tokenExpired;
        $this->newToken = $newToken;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function getTokenFound()
    {
        return $this->tokenFound;
    }

    public function getTokenExpired()
    {
        return $this->tokenExpired;
    }

    public function getNewToken()
    {
        return $this->newToken;
    }
}
