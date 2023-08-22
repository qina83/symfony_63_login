<?php

namespace App\Common\Domain\Permission;


use Szopen\SimpleAccessControl\Domain\PermissionsCollection;

interface PermissionsByRole
{


    public function isForRole(string $role): bool;
    public function permissions(): PermissionsCollection;
}
