<?php

namespace App\Security\Domain;

class Username
{
    public function __construct(
        public readonly string $value
    ) {
    }
}
