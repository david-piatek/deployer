<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

interface Git
{
    public function clone(string $url, string $destPath): bool;

    public function push(string $repoName): bool;
}
