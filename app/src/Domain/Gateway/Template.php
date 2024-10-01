<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

interface Template
{
    /**
     * @param array<mixed> $context
     */
    public function render(string $filepath, array $context): string;
}
