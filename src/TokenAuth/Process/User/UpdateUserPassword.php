<?php

namespace TokenAuth\Process\User;

use TokenAuth\Data\Repository\User\UserInterface;
use TokenAuth\Process\Password\PasswordHasherInterface;
use TokenAuth\Process\Request\UpdateUserPasswordRequest;
use TokenAuth\Process\Response\UpdateUserPasswordResponse;

class UpdateUserPassword
{
    private $userRepo;
    private $passwordHasher;

    public function __construct(
        UserInterface $userRepo,
        PasswordHasherInterface $passwordHasher
    ) {
        $this->userRepo = $userRepo;
        $this->passwordHasher = $passwordHasher;
    }

    public function updatePassword(UpdateUserPasswordRequest $request): UpdateUserPasswordResponse
    {
        $user = $this->userRepo->getUserById($request->getUserId());
        $oldPasswordHashed = $this->passwordHasher->hash($request->getOldRawPassword());
        if ($oldPasswordHashed !== $user->getPassword()) {
            return new UpdateUserPasswordResponse(false, false);
        }
        $newPasswordHashed = $this->passwordHasher->hash($request->getNewRawPassword());
        $this->userRepo->updatePassword($user, $newPasswordHashed);
        return new UpdateUserPasswordResponse(true, true);
    }
}
