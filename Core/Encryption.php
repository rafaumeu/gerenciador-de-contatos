<?php

declare(strict_types=1);

namespace Core;

class Encryption
{
    private const CIPHER = 'AES-256-CBC';

    private static function getKey(): string
    {
        $key = config('app.security.encryption_key');
        if (! $key) {
            throw new \RuntimeException('Encryption key not set in config/env');
        }

        return $key;
    }

    public static function encrypt(string $data): string
    {
        $ivLen = openssl_cipher_iv_length(self::CIPHER);
        $iv = openssl_random_pseudo_bytes($ivLen);
        $encrypted = openssl_encrypt($data, self::CIPHER, self::getKey(), 0, $iv);
        $mac = hash_hmac('sha256', $encrypted, self::getKey());

        return base64_encode($iv.$mac.$encrypted);
    }

    public static function decrypt(string $payload): ?string
    {
        $binary = base64_decode($payload);
        $ivLen = openssl_cipher_iv_length(self::CIPHER);
        $macLen = 64;
        if (strlen($binary) < $ivLen + $macLen) {
            return null;
        }
        $iv = substr($binary, 0, $ivLen);
        $mac = substr($binary, $ivLen, $macLen);
        $encrypted = substr($binary, $ivLen + $macLen);
        if (! hash_equals($mac, hash_hmac('sha256', $encrypted, self::getKey()))) {
            return null;
        }
        $decrypted = openssl_decrypt($encrypted, self::CIPHER, self::getKey(), 0, $iv);

        return $decrypted === false ? null : $decrypted;
    }
}
