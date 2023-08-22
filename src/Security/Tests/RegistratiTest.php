<?php

namespace App\Security\Tests;

use App\Common\Domain\Role\RoleProprietario;
use App\Security\Application\Registra;
use App\Security\Domain\Exception\UtenteEsistenteException;
use App\Security\Domain\Password;
use App\Security\Domain\SecurityUser;
use App\Security\Domain\SecurityUserPersister;
use App\Security\Domain\SecurityUserRepository;
use App\Security\Domain\Username;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistratiTest extends TestCase
{

    private Registra $registra;
    private SecurityUserPersister $securityUserPersister;
    private SecurityUserRepository $securityUserRepository;
    private UserPasswordHasherInterface $passwordHasher;


    protected function setUp(): void
    {
        parent::setUp();
        $this->securityUserPersister = $this->createMock(SecurityUserPersister::class);
        $this->securityUserRepository = $this->createMock(SecurityUserRepository::class);
        $this->passwordHasher = $this->createMock(UserPasswordHasherInterface::class);

        $this->registra = new Registra(
            $this->securityUserRepository,
            $this->securityUserPersister,
            $this->passwordHasher
        );
    }

    /** @test */
    public function registrati_deve_chiamare_il_persister_con_pw_hashata()
    {
        $username = new Username('username');
        $password = new Password('password');
        $role = new RoleProprietario();

        $hashedPwd = 'hashedPwd';
        $this->passwordHasher
            ->method('hashPassword')
            ->willReturn($hashedPwd);

        $this->securityUserRepository
            ->method('existsByUsername')
            ->willReturn(false);

        $expectedUser = new SecurityUser(
            $username,
            $role
        );
        $expectedUser->setPassword(new Password($hashedPwd));

        $this->securityUserPersister
            ->expects($this->once())
            ->method('persist')
            ->with($expectedUser);

        $this->registra->registrati(
            $username,
            $password,
            $role
        );
    }

    /** @test */
    public function registrati_deve_lanciare_eccezione_se_username_esiste_gia()
    {
        $username = new Username('username');
        $password = new Password('password');
        $role = new RoleProprietario();

        $this->securityUserRepository
            ->method('existsByUsername')
            ->willReturn(true);

        $this->expectException(UtenteEsistenteException::class);

        $this->registra->registrati(
            $username,
            $password,
            $role
        );
    }
}
