<?php
namespace TokenAuth\Data\Repository\User;

use TokenAuth\Data\Entity\User;

interface CreateUserInterface
{
    public function createUser(User $user): User;
}
