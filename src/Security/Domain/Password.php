<?php

namespace App\Security\Domain;

class Password
{
    public function __construct(
        public readonly string $value
    ) {
    }
}
