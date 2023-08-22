<?php

namespace App\Security\Tests;

use App\Common\Domain\Role\RoleProprietario;
use App\Security\Application\Login;
use App\Security\Domain\Exception\PasswordNonValidaException;
use App\Security\Domain\Exception\UtenteNonTrovatoException;
use App\Security\Domain\JwtEncoder;
use App\Security\Domain\Password;
use App\Security\Domain\SecurityUser;
use App\Security\Domain\SecurityUserRepository;
use App\Security\Domain\Username;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LoginTest extends TestCase
{
    private Login $login;
    private SecurityUserRepository $securityUserRepository;

    private UserPasswordHasherInterface $passwordHasher;

    private JwtEncoder $jwtEncoder;

    protected function setUp(): void
    {
        parent::setUp();
        $this->securityUserRepository = $this->createMock(SecurityUserRepository::class);
        $this->passwordHasher = $this->createMock(UserPasswordHasherInterface::class);
        $this->jwtEncoder = $this->createMock(JwtEncoder::class);

        $this->login = new Login(
            $this->securityUserRepository,
            $this->passwordHasher,
            $this->jwtEncoder
        );
    }

    /** @test */
    public function deve_lanciare_eccezione_se_username_non_esiste()
    {
        $this->securityUserRepository
            ->method('byUsername')
            ->willReturn(null);

        $this->expectException(UtenteNonTrovatoException::class);

        $this->login->login(
            new Username('username_non_esistente'),
            new Password('password')
        );
    }

    /** @test */
    public function deve_lanciare_eccezione_se_la_pw_non_e_corretta()
    {
        $username = new Username('username');
        $user = new SecurityUser(
            $username,
            new RoleProprietario()
        );

        $this->securityUserRepository
            ->method('byUsername')
            ->willReturn($user);

        $this->passwordHasher
            ->method('isPasswordValid')
            ->willReturn(false);

        $this->expectException(PasswordNonValidaException::class);

        $this->login->login(
            $username,
            new Password('password_errata')
        );
    }

    /** @test */
    public function deve_tornare_il_token_jwt_in_caso_di_dati_validi()
    {
        $username = new Username('username');
        $user = new SecurityUser(
            $username,
            new RoleProprietario()
        );

        $this->securityUserRepository
            ->method('byUsername')
            ->willReturn($user);

        $this->passwordHasher
            ->method('isPasswordValid')
            ->willReturn(true);

        $this->jwtEncoder
            ->method('encode')
            ->willReturn('jwt_token');

        $jwtToken = $this->login->login(
            $username,
            new Password('password')
        );

        $this->assertEquals('jwt_token', $jwtToken);
    }
}
