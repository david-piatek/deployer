<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

interface Template
{
    public function render(string $appName): string;
}
