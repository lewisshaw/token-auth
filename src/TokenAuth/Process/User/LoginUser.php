<?php

namespace TokenAuth\Process\User;

use TokenAuth\Data\Repository\User\GetUserInterface;
use TokenAuth\Process\Password\PasswordVerifierInterface;
use TokenAuth\Process\Request\GenerateTokenRequest;
use TokenAuth\Process\Request\LoginUserRequest;
use TokenAuth\Process\Response\LoginUserResponse;
use TokenAuth\Process\Token\GenerateTokenInterface;

class LoginUser
{
    private GenerateTokenInterface $tokenGenerator;
    private GetUserInterface $userRepo;
    private PasswordVerifierInterface $passwordVerifier;

    public function __construct(
        GenerateTokenInterface $tokenGenerator,
        GetUserInterface $userRepo,
        PasswordVerifierInterface $passwordVerifier
    ) {
        $this->tokenGenerator = $tokenGenerator;
        $this->userRepo = $userRepo;
        $this->passwordVerifier = $passwordVerifier;
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
        $token = $this->tokenGenerator->getToken($tokenRequest);
        return new LoginUserResponse(true, $token->getToken());
    }
}
