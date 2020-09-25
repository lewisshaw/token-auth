<?php
namespace TokenAuth\Process\Response;

class UpdateUserPasswordResponse
{
    private $oldPasswordMatch;
    private $updated;

    public function __construct(bool $oldPasswordMatch, bool $updated)
    {
        $this->oldPasswordMatch = $oldPasswordMatch;
        $this->updated = $updated;
    }

    public function getOldPasswordMatch()
    {
        return $this->oldPasswordMatch;
    }

    public function getUpdated()
    {
        return $this->updated;
    }
}
