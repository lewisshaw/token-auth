<?php

namespace TokenAuth\Process\Response;

use TokenAuth\Data\Entity\User;

class CreateUserResponse
{
    private ?User $user = null;
    private bool $isEmailTaken;

    public function __construct(bool $emailTaken, ?User $user = null)
    {
        $this->user = $user;
        $this->isEmailTaken = $emailTaken;
    }

    public function isEmailTaken()
    {
        return $this->isEmailTaken;
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
