<?php

namespace App\Security\Infrastructure\Repository;

use App\Security\Domain\SecurityUser;
use App\Security\Domain\SecurityUserPersister;
use App\Security\Domain\SecurityUserRepository;
use App\Security\Domain\Username;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PostgreSecurityUserRepository extends ServiceEntityRepository implements SecurityUserRepository, SecurityUserPersister
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SecurityUser::class);
    }

    public function byUsername(Username $username): ?SecurityUser
    {
        return $this->findOneBy(['username' => $username->value]);
    }

    public function existsByUsername(Username $username): bool
    {
        return $this->findOneBy(['username' => $username->value]) !== null;
    }

    public function persist(SecurityUser $securityUser): void
    {
        $this->_em->persist($securityUser);
        $this->_em->flush();
    }
}
