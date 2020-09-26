<?php

namespace TokenAuth\Data\Entity;

use LogicException;

class User
{
    private ?int $userId = null;
    private string $emailAddress;
    private string $password;
    private string $name;

    public function __construct(
        string $emailAddress,
        string $password,
        string $name
    ) {
        $this->emailAddress = $emailAddress;
        $this->password = $password;
        $this->name = $name;
    }

    public function setUserId(int $userId): void
    {
        if (null !== $this->userId) {
            throw new LogicException('Cannot set ID when ID already set');
        }
        $this->userId = $userId;
    }

    public function getUserId(): int
    {
        if (null === $this->userId) {
            throw new LogicException('Cannot get user ID when it is not set');
        }
        return $this->userId;
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
