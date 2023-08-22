<?php

namespace App\Common\Domain\Role;

abstract class Role
{
    public function __construct(
        private string $role
    ) {
    }

    public function isSameOf(string $role)
    {
        return $role === $this->role;
    }

    public function value():string
    {
        return $this->role;
    }
}
