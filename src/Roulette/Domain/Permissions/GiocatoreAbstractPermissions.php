<?php

namespace App\Roulette\Domain\Permissions;


use App\Common\Domain\Permission\AbstractPermissionsByRole;
use App\Common\Domain\Role\RoleGiocatore;
use Szopen\SimpleAccessControl\Domain\Action;
use Szopen\SimpleAccessControl\Domain\Permission;
use Szopen\SimpleAccessControl\Domain\PermissionsCollection;

class
GiocatoreAbstractPermissions extends AbstractPermissionsByRole
{
    public function __construct()
    {
        $rolePermissions[] = new Permission(new Action('roulette.partita.scommetti'), true);

        parent::__construct(
            new PermissionsCollection($rolePermissions),
            new RoleGiocatore()
        );

    }
}
