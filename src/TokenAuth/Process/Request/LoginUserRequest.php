<?php

namespace TokenAuth\Process\Request;

class LoginUserRequest
{
    private string $email;
    private string $rawPassword;

    public function __construct(string $email, string $rawPassword)
    {
        $this->email = $email;
        $this->rawPassword = $rawPassword;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRawPassword(): string
    {
        return $this->rawPassword;
    }
}
