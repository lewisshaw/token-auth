<?php

namespace TokenAuth\Process\User;

use TokenAuth\Data\Repository\User\GetUserInterface;
use TokenAuth\Process\Password\PasswordHasherInterface;
use TokenAuth\Process\Request\GenerateTokenRequest;
use TokenAuth\Process\Request\LoginUserRequest;
use TokenAuth\Process\Response\LoginUserResponse;
use TokenAuth\Process\Token\GenerateTokenInterface;

class LoginUser
{
    private GenerateTokenInterface $tokenGenerator;
    private GetUserInterface $userRepo;
    private PasswordHasherInterface $passwordHasher;

    public function __construct(
        GenerateTokenInterface $tokenGenerator,
        GetUserInterface $userRepo,
        PasswordHasherInterface $passwordHasher
    ) {
        $this->tokenGenerator = $tokenGenerator;
        $this->userRepo = $userRepo;
        $this->passwordHasher = $passwordHasher;
    }

    public function login(LoginUserRequest $request): LoginUserResponse
    {
        $user = $this->userRepo->getUserByEmail($request->getEmail());
        if (null === $user) {
            return new LoginUserResponse(false);
        }

        $hashedPassword = $this->passwordHasher->hash($request->getRawPassword());
        if ($hashedPassword !== $user->getPassword()) {
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
