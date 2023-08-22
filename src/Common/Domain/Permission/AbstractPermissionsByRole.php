<?php

namespace App\Common\Domain\Permission;


use App\Common\Domain\Role\Role;
use Szopen\SimpleAccessControl\Domain\PermissionsCollection;

abstract class AbstractPermissionsByRole implements PermissionsByRole
{
    public function __construct(
        private PermissionsCollection $permissions,
        private Role $role
    ) {
    }

    public function isForRole(string $role): bool
    {
        return $this->role->isSameOf($role);
    }

    public function permissions(): PermissionsCollection
    {
        return $this->permissions;
    }
}
