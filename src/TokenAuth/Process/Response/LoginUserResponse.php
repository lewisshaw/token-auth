<?php

namespace TokenAuth\Process\Response;

class LoginUserResponse
{
    private $isLoginValid;
    private $token;

    public function __construct($isLoginValid, $token = null)
    {
        $this->isLoginValid = $isLoginValid;
        $this->token = $token;
    }

    public function isLoginValid()
    {
        return $this->isLoginValid;
    }

    public function getToken()
    {
        return $this->token;
    }
}
