<?php

namespace TokenAuth\Process\Password;

interface PasswordVerifierInterface
{
    public function isPasswordCorrect(string $rawPassword, string $hash): bool;
}
