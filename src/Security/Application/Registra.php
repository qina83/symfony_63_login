<?php

namespace App\Security\Application;

use App\Common\Domain\Role\Role;
use App\Security\Domain\Exception\UtenteEsistenteException;
use App\Security\Domain\Password;
use App\Security\Domain\SecurityUser;
use App\Security\Domain\SecurityUserPersister;
use App\Security\Domain\SecurityUserRepository;
use App\Security\Domain\Username;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class Registra
{
    public function __construct(
        private readonly SecurityUserRepository $securityUserRepository,
        private readonly SecurityUserPersister $securityUserPersister,
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function registrati(Username $username, Password $password, Role $role): void
    {
        if ($this->securityUserRepository->existsByUsername($username)) {
            throw UtenteEsistenteException::byUsername($username);
        }

        $securityUser = new SecurityUser($username, $role);

        $hashedPassword = $this->passwordHasher->hashPassword(
            $securityUser,
            $password->value
        );
        $securityUser->setPassword(new Password($hashedPassword));
        $this->securityUserPersister->persist($securityUser);
    }

}
