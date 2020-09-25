<?php

namespace TokenAuth\Data\Repository\User;

use TokenAuth\Data\Entity\User;

interface UpdateUserInterface
{
    public function updatePassword(User $user, string $password);
}
