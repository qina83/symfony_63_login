<?php

namespace App\Common\Domain\Role;

class RoleProprietario extends Role
{
    public function __construct()
    {
        parent::__construct('ROLE_PROPRIETARIO');
    }
}
