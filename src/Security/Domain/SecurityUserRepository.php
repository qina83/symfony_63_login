<?php

namespace App\Security\Domain;

interface SecurityUserRepository
{
    public function byUsername(Username $username): ?SecurityUser;
    public function existsByUsername(Username $username): bool;
}
