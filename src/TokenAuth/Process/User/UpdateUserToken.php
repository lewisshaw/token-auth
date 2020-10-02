<?php

namespace TokenAuth\Process\User;

use TokenAuth\Data\Repository\RefreshToken\GetRefreshTokenInterface;
use TokenAuth\Data\Repository\User\GetUserInterface;
use TokenAuth\Process\Request\GenerateTokenRequest;
use TokenAuth\Process\Request\UpdateTokenRequest;
use TokenAuth\Process\Response\UpdateTokenResponse;
use TokenAuth\Process\Token\GenerateTokenInterface;
use TokenAuth\Process\Token\TokenValidatorInterface;

class UpdateUserToken
{
    private GetRefreshTokenInterface $refreshTokenRepo;
    private GenerateTokenInterface $tokenGenerator;
    private GetUserInterface $userRepo;
    private TokenValidatorInterface $tokenValidator;

    public function __construct(
        GetRefreshTokenInterface $refreshTokenRepo,
        GenerateTokenInterface $tokenGenerator,
        GetUserInterface $userRepo,
        TokenValidatorInterface $tokenValidator
    ) {
        $this->refreshTokenRepo = $refreshTokenRepo;
        $this->tokenGenerator = $tokenGenerator;
        $this->userRepo = $userRepo;
        $this->tokenValidator = $tokenValidator;
    }

    public function updateToken(UpdateTokenRequest $request): UpdateTokenResponse
    {
        $user = $this->userRepo->getUserById($request->getUserId());
        $token = $this->refreshTokenRepo->getRefreshTokenForUser($user);
        if (null === $token) {
            return new UpdateTokenResponse(false, false, false, false);
        }
        $validToken = $this->tokenValidator->isValidToken($token->getToken());
        if (!$validToken) {
            return new UpdateTokenResponse(false, true, true, false);
        }
        if ($request->getRefreshToken() !== $token->getToken()) {
            return new UpdateTokenResponse(false, true, false, true);
        }
        $tokenRequest = new GenerateTokenRequest(
            $user->getEmailAddress(),
            []
        );
        $newToken = $this->tokenGenerator->getToken($tokenRequest);
        return new UpdateTokenResponse(true, true, false, false, $newToken->getToken());
    }
}
