<?php

namespace App\Domain\Enum;

enum CloneType: string
{
    case SSH = 'ssh';
    case HTTPS = 'https';

    public function separator(): string
    {
        return match ($this) {
            self::SSH => ':',
            self::HTTPS => '/',
        };
    }

    public function connexionPrefix(): string
    {
        return match ($this) {
            self::SSH => 'git@',
            self::HTTPS => 'https://oauth2:',
        };
    }
}
