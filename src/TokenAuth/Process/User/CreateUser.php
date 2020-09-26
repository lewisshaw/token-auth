<?php

namespace TokenAuth\Process\User;

use TokenAuth\Data\Entity\User;
use TokenAuth\Data\Repository\User\CreateUserInterface;
use TokenAuth\Process\Password\PasswordHasherInterface;
use TokenAuth\Process\Request\CreateUserRequest;
use TokenAuth\Process\Response\CreateUserResponse;

class CreateUser
{
    private CreateUserInterface $createUserRepo;
    private PasswordHasherInterface $passwordHasher;

    public function __construct(
        CreateUserInterface $createUserRepo,
        PasswordHasherInterface $passwordHasher
    ) {
        $this->createUserRepo = $createUserRepo;
        $this->passwordHasher = $passwordHasher;
    }

    public function create(CreateUserRequest $request): CreateUserResponse
    {
        $password = $this->passwordHasher->hash($request->getRawPassword());
        $user = new User(
            $request->getEmailAddress(),
            $password,
            $request->getName()
        );

        $user = $this->createUserRepo->createUser($user);

        return new CreateUserResponse($user);
    }
}
