<?php

namespace TokenAuth\Data\Repository\RefreshToken;

use TokenAuth\Data\Entity\Token;
use TokenAuth\Data\Entity\User;

interface GetRefreshTokenInterface
{
    public function getRefreshTokenForUser(User $user): ?Token;
}
