<?php
namespace TokenAuth\Data\Repository\User;

use TokenAuth\Data\Entity\User;

interface GetUserInterface
{
    public function getUserByEmail(string $email): ?User;

    public function getUserById(int $userId): User;
}
