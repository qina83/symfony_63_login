<?php

namespace App\Security\Domain\Exception;

use App\Security\Domain\Username;

class UtenteEsistenteException extends \DomainException
{
    public static function byUsername(Username $username)
    {
        return new self(sprintf('Utente %s già esitente', $username->value));
    }
}
