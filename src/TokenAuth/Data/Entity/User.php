<?php

namespace TokenAuth\Data\Entity;

use LogicException;

class User
{
    private $userId;
    private $emailAddress;
    private $password;
    private $name;

    public function __construct(
        $emailAddress,
        $password,
        $name
    ) {
        $this->emailAddress = $emailAddress;
        $this->password = $password;
        $this->name = $name;
    }

    public function setUserId(int $userId)
    {
        if (null !== $this->userId) {
            throw new LogicException('Cannot set ID when ID already set');
        }
        $this->userId = $userId;
    }

    public function getUserId()
    {
        if (null === $this->userId) {
            throw new LogicException('Cannot get user ID when it is not set');
        }
        return $this->userId;
    }

    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getName()
    {
        return $this->name;
    }
}
