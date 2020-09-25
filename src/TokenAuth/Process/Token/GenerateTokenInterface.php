<?php

namespace TokenAuth\Process\Token;

use TokenAuth\Process\Request\GenerateTokenRequest;
use TokenAuth\Process\Response\GenerateTokenResponse;

interface GenerateTokenInterface
{
    public function getToken(GenerateTokenRequest $request): GenerateTokenResponse;
}
