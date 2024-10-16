<?php

declare(strict_types=1);

namespace App\Application;

readonly class DeployCommand
{
    public function __construct(
        public string $appName,
    ) {
    }
}
