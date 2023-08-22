<?php

namespace App\Security\Domain;

interface SecurityUserPersister
{
    public function persist(SecurityUser $securityUser): void;
}
