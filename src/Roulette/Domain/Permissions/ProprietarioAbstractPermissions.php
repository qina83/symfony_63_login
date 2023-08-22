<?php

namespace App\Roulette\Domain\Permissions;


use App\Common\Domain\Permission\AbstractPermissionsByRole;
use App\Common\Domain\Role\RoleProprietario;
use Szopen\SimpleAccessControl\Domain\Action;
use Szopen\SimpleAccessControl\Domain\Permission;
use Szopen\SimpleAccessControl\Domain\PermissionsCollection;

class ProprietarioAbstractPermissions extends AbstractPermissionsByRole
{
    public function __construct()
    {
        $rolePermissions[] = new Permission(new Action('roulette.tavolo.chiudi'), true);
        $rolePermissions[] = new Permission(new Action('roulette.tavolo.pulisci'), true);

        parent::__construct(
            new PermissionsCollection($rolePermissions),
            new RoleProprietario()
        );

    }
}
