<?php

namespace TokenAuth\Process\Token;

interface TokenValidatorInterface
{
    public function isValidToken(string $token): bool;
}
