<?php

namespace TokenAuth\Process\Request;

class LoginUserRequest
{
    private $email;
    private $rawPassword;

    public function __construct($email, $rawPassword)
    {
        $this->email = $email;
        $this->rawPassword = $rawPassword;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRawPassword()
    {
        return $this->rawPassword;
    }
}
