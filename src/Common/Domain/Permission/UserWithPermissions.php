<?php

namespace App\Common\Domain\Permission;

use App\Security\Domain\SecurityUser;
use Szopen\SimpleAccessControl\Domain\PermissionsCollection;

class UserWithPermissions implements \Szopen\SimpleAccessControl\Domain\User\UserWithPermissions
{
    public function __construct(
        private SecurityUser $securityUser,
        private PermissionsCollection $permissionsCollection
    )
    {
    }

    public function getUser(): SecurityUser
    {
        return $this->securityUser;
    }

    public function getPermissions(): PermissionsCollection
    {
        return $this->permissionsCollection;
    }

}
