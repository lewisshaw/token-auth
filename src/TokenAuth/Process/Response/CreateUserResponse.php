<?php

namespace TokenAuth\Process\Response;

use TokenAuth\Data\Entity\User;

class CreateUserResponse
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function getUserId()
    {
        return $this->user->getUserId();
    }

    public function getEmailAddress()
    {
        return $this->user->getEmailAddress();
    }

    public function getPassword()
    {
        return $this->user->getPassword();
    }

    public function getName()
    {
        return $this->user->getName();
    }
}
