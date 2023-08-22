<?php

namespace App\Security\Domain;

interface JwtDecoder
{
    public function decode(string $bearerToken): JwtPayload;
}
