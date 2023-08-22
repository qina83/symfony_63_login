<?php

namespace App\Security\Domain\Exception;

use App\Security\Domain\Username;

class PasswordNonValidaException extends \DomainException
{
    public static function byUsername(Username $username)
    {
        return new self(sprintf('Password per l\'utente %s non valida', $username->value));
    }
}
