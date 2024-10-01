<?php

declare(strict_types=1);

namespace App\Domain;

interface Template
{
    public function render(string $appName): string;
}