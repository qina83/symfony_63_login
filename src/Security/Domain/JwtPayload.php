<?php

namespace App\Security\Domain;

readonly class JwtPayload
{
    public function __construct(
        public Username $username
    )
    {

    }
}
