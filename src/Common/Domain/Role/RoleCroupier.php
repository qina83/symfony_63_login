<?php

namespace App\Common\Domain\Role;

class RoleCroupier extends Role
{
    public function __construct()
    {
        parent::__construct('ROLE_CROUPIER');
    }
}
