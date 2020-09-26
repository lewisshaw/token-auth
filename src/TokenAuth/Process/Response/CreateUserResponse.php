<?php

namespace TokenAuth\Process\Response;

use TokenAuth\Data\Entity\User;

class CreateUserResponse
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function getUserId(): int
    {
        return $this->user->getUserId();
    }

    public function getEmailAddress(): string
    {
        return $this->user->getEmailAddress();
    }

    public function getPassword(): string
    {
        return $this->user->getPassword();
    }

    public function getName(): string
    {
        return $this->user->getName();
    }
}
