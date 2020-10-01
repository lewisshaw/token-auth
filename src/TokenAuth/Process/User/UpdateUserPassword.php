<?php

namespace TokenAuth\Process\User;

use TokenAuth\Data\Repository\User\UserInterface;
use TokenAuth\Process\Password\PasswordHasherInterface;
use TokenAuth\Process\Password\PasswordVerifierInterface;
use TokenAuth\Process\Request\UpdateUserPasswordRequest;
use TokenAuth\Process\Response\UpdateUserPasswordResponse;

class UpdateUserPassword
{
    private UserInterface $userRepo;
    private PasswordHasherInterface $passwordHasher;
    private PasswordVerifierInterface $passwordVerifier;

    public function __construct(
        UserInterface $userRepo,
        PasswordHasherInterface $passwordHasher,
        PasswordVerifierInterface $passwordVerifier
    ) {
        $this->userRepo = $userRepo;
        $this->passwordHasher = $passwordHasher;
        $this->passwordVerifier = $passwordVerifier;
    }

    public function updatePassword(UpdateUserPasswordRequest $request): UpdateUserPasswordResponse
    {
        $user = $this->userRepo->getUserById($request->getUserId());
        $oldPasswordCorrect = $this->passwordVerifier->isPasswordCorrect(
            $request->getOldRawPassword(),
            $user->getPassword()
        );
        if (!$oldPasswordCorrect) {
            return new UpdateUserPasswordResponse(false, false);
        }
        $newPasswordHashed = $this->passwordHasher->hash($request->getNewRawPassword());
        $this->userRepo->updatePassword($user, $newPasswordHashed);
        return new UpdateUserPasswordResponse(true, true);
    }
}
