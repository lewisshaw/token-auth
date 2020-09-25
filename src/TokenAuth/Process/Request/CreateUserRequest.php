<?php

namespace TokenAuth\Process\Request;

class CreateUserRequest
{
    private $emailAddress;
    private $rawPassword;
    private $name;

    public function __construct(
        $emailAddress,
        $rawPassword,
        $name
    ) {
        $this->emailAddress = $emailAddress;
        $this->rawPassword = $rawPassword;
        $this->name = $name;
    }

    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    public function getRawPassword()
    {
        return $this->rawPassword;
    }

    public function getName()
    {
        return $this->name;
    }
}
