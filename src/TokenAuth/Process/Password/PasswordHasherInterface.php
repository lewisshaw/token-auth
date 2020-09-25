<?php

namespace TokenAuth\Process\Password;

interface PasswordHasherInterface
{
    public function hash(string $password): string;
}
