<?php

namespace TokenAuth\Process\Request;

class GenerateTokenRequest
{
    private $email;
    private $extraTokenData;

    public function __construct($email, $extraTokenData)
    {
        $this->email = $email;
        $this->extraTokenData = $extraTokenData;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getExtraTokenData()
    {
        return $this->extraTokenData;
    }
}
