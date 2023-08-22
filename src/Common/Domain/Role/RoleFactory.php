<?php

namespace App\Common\Domain\Role;

class RoleFactory
{
    public function createRole(string $role): Role
    {
        switch ($role){
            case 'proprietario': return new RoleProprietario();
            case 'croupier': return new RoleCroupier();
            case 'giocatore': return new RoleGiocatore();
        }

        throw new \DomainException(sprintf('Ruolo %s non riconosciuto', $role));
    }
}
