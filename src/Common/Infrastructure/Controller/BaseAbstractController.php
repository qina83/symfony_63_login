<?php

namespace App\Common\Infrastructure\Controller;

use App\Common\Domain\Permission\RolePermissions;
use App\Common\Domain\Permission\UserWithPermissions;
use App\Security\Domain\SecurityUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class BaseAbstractController extends AbstractController
{
    public function __construct(
        private RolePermissions $rolePermissions
    )
    {
    }

    public function getUserWithPermission(): UserWithPermissions
    {
        /** @var SecurityUser $user */
        $user = $this->getUser();

        //carica i permessi del singolo utente (Adesso assenti)
        //poi carica i permessi per ruolo
        $permissions = $this->rolePermissions->enanchePermission($user);

        return new UserWithPermissions(
            $user,
            $permissions
        );

    }
}
