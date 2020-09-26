<?php

namespace TokenAuth\Process\Response;

class UpdateUserPasswordResponse
{
    private bool $oldPasswordMatch;
    private bool $updated;

    public function __construct(bool $oldPasswordMatch, bool $updated)
    {
        $this->oldPasswordMatch = $oldPasswordMatch;
        $this->updated = $updated;
    }

    public function getOldPasswordMatch(): bool
    {
        return $this->oldPasswordMatch;
    }

    public function getUpdated(): bool
    {
        return $this->updated;
    }
}
