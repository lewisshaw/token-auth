<?php

namespace TokenAuth\Process\Request;

class CreateUserRequest
{
    private string $emailAddress;
    private string $rawPassword;
    private string $name;

    public function __construct(
        string $emailAddress,
        string $rawPassword,
        string $name
    ) {
        $this->emailAddress = $emailAddress;
        $this->rawPassword = $rawPassword;
        $this->name = $name;
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function getRawPassword(): string
    {
        return $this->rawPassword;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
