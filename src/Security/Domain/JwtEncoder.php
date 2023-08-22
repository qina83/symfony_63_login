<?php

namespace App\Security\Domain;

interface JwtEncoder
{
    public function encode(JwtPayload $jwtPayload): string;
}
