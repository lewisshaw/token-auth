<?php

namespace TokenAuth\Process\User;

use TokenAuth\Data\Entity\User;
use TokenAuth\Data\Repository\User\CreateUserInterface;
use TokenAuth\Data\Repository\User\GetUserInterface;
use TokenAuth\Process\Password\PasswordHasherInterface;
use TokenAuth\Process\Request\CreateUserRequest;
use TokenAuth\Process\Response\CreateUserResponse;

class CreateUser
{
    private CreateUserInterface $createUserRepo;
    private GetUserInterface $getUserRepo;
    private PasswordHasherInterface $passwordHasher;

    public function __construct(
        CreateUserInterface $createUserRepo,
        PasswordHasherInterface $passwordHasher,
        GetUserInterface $getUserRepo
    ) {
        $this->createUserRepo = $createUserRepo;
        $this->passwordHasher = $passwordHasher;
        $this->getUserRepo = $getUserRepo;
    }

    public function create(CreateUserRequest $request): CreateUserResponse
    {
        $existingUser = $this->getUserRepo->getUserByEmail($request->getEmailAddress());
        if (null !== $existingUser) {
            return new CreateUserResponse(true);
        }
        $password = $this->passwordHasher->hash($request->getRawPassword());
        $user = new User(
            $request->getEmailAddress(),
            $password,
            $request->getName()
        );

        $user = $this->createUserRepo->createUser($user);

        return new CreateUserResponse(false, $user);
    }
}
