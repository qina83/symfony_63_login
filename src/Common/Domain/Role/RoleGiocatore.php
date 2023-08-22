<?php

namespace App\Common\Domain\Role;

class RoleGiocatore extends Role
{
    public function __construct()
    {
        parent::__construct('ROLE_GIOCATORE');
    }
}
