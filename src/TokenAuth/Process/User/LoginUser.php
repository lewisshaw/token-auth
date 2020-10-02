<?php

namespace TokenAuth\Process\User;

use TokenAuth\Data\Entity\Token;
use TokenAuth\Data\Repository\RefreshToken\SaveRefreshTokenInterface;
use TokenAuth\Data\Repository\User\GetUserInterface;
use TokenAuth\Process\Password\PasswordVerifierInterface;
use TokenAuth\Process\Request\GenerateTokenRequest;
use TokenAuth\Process\Request\LoginUserRequest;
use TokenAuth\Process\Response\LoginUserResponse;
use TokenAuth\Process\Token\GenerateTokenInterface;

class LoginUser
{
    private GenerateTokenInterface $tokenGenerator;
    private GenerateTokenInterface $refreshTokGenerator;
    private GetUserInterface $userRepo;
    private PasswordVerifierInterface $passwordVerifier;
    private SaveRefreshTokenInterface $tokenSaver;

    public function __construct(
        GenerateTokenInterface $tokenGenerator,
        GenerateTokenInterface $refreshTokGenerator,
        GetUserInterface $userRepo,
        PasswordVerifierInterface $passwordVerifier,
        SaveRefreshTokenInterface $tokenSaver
    ) {
        $this->tokenGenerator = $tokenGenerator;
        $this->refreshTokGenerator = $refreshTokGenerator;
        $this->userRepo = $userRepo;
        $this->passwordVerifier = $passwordVerifier;
        $this->tokenSaver = $tokenSaver;
    }

    public function login(LoginUserRequest $request): LoginUserResponse
    {
        $user = $this->userRepo->getUserByEmail($request->getEmail());
        if (null === $user) {
            return new LoginUserResponse(false);
        }

        $passwordCorrect = $this->passwordVerifier->isPasswordCorrect(
            $request->getRawPassword(),
            $user->getPassword()
        );
        if (!$passwordCorrect) {
            return new LoginUserResponse(false);
        }

        $tokenRequest = new GenerateTokenRequest(
            $request->getEmail(),
            []
        );
        $refreshToken = $this->refreshTokGenerator->getToken($tokenRequest);
        $this->tokenSaver->saveRefreshToken($user, new Token($refreshToken->getToken()));
        $token = $this->tokenGenerator->getToken($tokenRequest);
        return new LoginUserResponse(true, $token->getToken());
    }
}
