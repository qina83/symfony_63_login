<?php

namespace App\Security\Domain\Exception;

use App\Security\Domain\Username;

class UtenteNonTrovatoException extends \DomainException
{
    public static function byUsername(Username $username)
    {
        return new self(sprintf('Utente %s non trovato', $username->value));
    }
}
