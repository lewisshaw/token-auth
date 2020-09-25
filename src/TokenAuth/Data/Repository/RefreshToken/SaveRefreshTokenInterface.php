<?php

namespace TokenAuth\Data\Repository\RefreshToken;

use TokenAuth\Data\Entity\Token;
use TokenAuth\Data\Entity\User;

interface SaveRefreshTokenInterface
{
    public function saveRefreshToken(User $user, Token $token);
}
