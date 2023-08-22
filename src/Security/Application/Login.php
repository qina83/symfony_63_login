<?php

namespace App\Security\Application;

use App\Common\Domain\Role\Role;
use App\Security\Domain\Exception\PasswordNonValidaException;
use App\Security\Domain\Exception\UtenteNonTrovatoException;
use App\Security\Domain\JwtEncoder;
use App\Security\Domain\JwtPayload;
use App\Security\Domain\Password;
use App\Security\Domain\SecurityUser;
use App\Security\Domain\SecurityUserPersister;
use App\Security\Domain\SecurityUserRepository;
use App\Security\Domain\Username;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class Login
{
    public function __construct(
        private SecurityUserRepository $securityUserRepository,
        private UserPasswordHasherInterface $passwordHasher,
        private JwtEncoder $jwtEncoder
    ) {
    }

    public function login(Username $username, Password $password): string
    {
        $securityUser = $this->securityUserRepository->byUsername($username);
        if ($securityUser === null) {
            throw UtenteNonTrovatoException::byUsername($username);
        }

        if (!$this->passwordHasher->isPasswordValid($securityUser, $password->value)) {
            throw PasswordNonValidaException::byUsername($username);
        }

        return $this->jwtEncoder->encode(new JwtPayload($securityUser->getUsername()));

    }

}
