<?php

namespace App\Common\Domain\Permission;

use App\Security\Domain\SecurityUser;
use IteratorAggregate;
use Szopen\SimpleAccessControl\Domain\PermissionsCollection;

class RolePermissions
{
    /** @var  AbstractPermissionsByRole[] */
    private IteratorAggregate $permissionsByRoles;

    public function __construct(
        IteratorAggregate $permissionsByRoles
    ) {
        $this->permissionsByRoles = $permissionsByRoles;
    }

    public function enanchePermission(SecurityUser $securityUser): PermissionsCollection
    {
        $rolePermissions = [];
        $roles = $securityUser->getRoles();

        foreach ($this->permissionsByRoles as $permissionsByRole) {
            foreach ($roles as $role) {
                if ($permissionsByRole->isForRole($role)) {
                    foreach ($permissionsByRole->permissions() as $rolePermission) {
                        $rolePermissions[] = $rolePermission;
                    }
                }
            }
        }

        return new PermissionsCollection($rolePermissions);
    }
}
