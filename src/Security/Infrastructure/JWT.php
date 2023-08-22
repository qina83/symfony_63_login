<?php

namespace App\Security\Infrastructure;

use App\Security\Domain\JwtDecoder;
use App\Security\Domain\JwtEncoder;
use App\Security\Domain\JwtPayload;
use App\Security\Domain\Username;
use Firebase\JWT\JWT as FirebaseJWT;
use Firebase\JWT\Key;

class JWT implements JwtEncoder, JwtDecoder
{

    const KEY = "customKey";

    public function decode(string $bearerToken): JwtPayload
    {
        $token = str_replace('Bearer ', '', $bearerToken);
        $decoded = FirebaseJWT::decode($token, new Key(self::KEY, 'HS256'));
        return new JwtPayload(
            new Username($decoded->username)
        );
    }

    public function encode(JwtPayload $jwtPayload): string
    {
        $payload = [
            'username' => $jwtPayload->username->value,
        ];
        return FirebaseJWT::encode($payload, self::KEY, 'HS256');
    }
}
