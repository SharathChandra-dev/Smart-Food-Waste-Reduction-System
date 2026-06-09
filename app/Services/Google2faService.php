<?php

namespace App\Services;

class Google2faService
{
    public static function generateSecretKey(int $length = 16): string
    {
        $randomBytes = random_bytes($length);
        return rtrim(self::base32Encode($randomBytes), '=');
    }

    public static function getOtpAuthUrl(string $appName, string $username, string $secret): string
    {
        $label = rawurlencode($appName . ':' . $username);
        $issuer = rawurlencode($appName);

        return sprintf(
            'otpauth://totp/%s?secret=%s&issuer=%s&algorithm=SHA1&digits=6&period=30',
            $label,
            rawurlencode($secret),
            $issuer
        );
    }

    public static function verifyKey(string $secret, string $code, int $window = 1): bool
    {
        $code = trim($code);
        if (!ctype_digit($code)) {
            return false;
        }

        for ($i = -$window; $i <= $window; $i++) {
            if (self::getCurrentOtp($secret, $i) === $code) {
                return true;
            }
        }

        return false;
    }

    public static function getCurrentOtp(string $secret, int $offset = 0): string
    {
        $period = 30;
        $timestamp = floor(time() / $period) + $offset;
        $secretKey = self::base32Decode($secret);
        $time = pack('N*', 0) . pack('N*', $timestamp);
        $hash = hash_hmac('sha1', $time, $secretKey, true);
        $offset = ord($hash[19]) & 0x0F;
        $truncatedHash = substr($hash, $offset, 4);
        $value = unpack('N', $truncatedHash)[1] & 0x7FFFFFFF;
        $code = $value % pow(10, 6);

        return str_pad((string)$code, 6, '0', STR_PAD_LEFT);
    }

    private static function base32Encode(string $data): string
    {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $binary = '';
        $length = strlen($data);

        for ($i = 0; $i < $length; $i++) {
            $binary .= str_pad(decbin(ord($data[$i])), 8, '0', STR_PAD_LEFT);
        }

        $binary = str_split($binary, 5);
        $base32 = '';

        foreach ($binary as $chunk) {
            if (strlen($chunk) < 5) {
                $chunk = str_pad($chunk, 5, '0', STR_PAD_RIGHT);
            }
            $base32 .= $alphabet[bindec($chunk)];
        }

        while (strlen($base32) % 8 !== 0) {
            $base32 .= '=';
        }

        return $base32;
    }

    private static function base32Decode(string $secret): string
    {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $secret = strtoupper(rtrim($secret, '='));
        $binary = '';

        foreach (str_split($secret) as $char) {
            $pos = strpos($alphabet, $char);
            if ($pos === false) {
                continue;
            }
            $binary .= str_pad(decbin($pos), 5, '0', STR_PAD_LEFT);
        }

        $chunks = str_split($binary, 8);
        $decoded = '';

        foreach ($chunks as $chunk) {
            if (strlen($chunk) === 8) {
                $decoded .= chr(bindec($chunk));
            }
        }

        return $decoded;
    }
}
