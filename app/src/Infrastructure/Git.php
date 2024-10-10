<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Gateway\Git as GitInterface;

class Git implements GitInterface
{
    public function clone(string $url, string $destPath): bool
    {
        return true;
    }

    public function push(string $repoName): bool
    {
        return true;
    }
}
