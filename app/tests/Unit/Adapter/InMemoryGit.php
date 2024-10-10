<?php

declare(strict_types=1);

namespace Tests\App\Unit\Adapter;

use App\Domain\Gateway\Git;

final class InMemoryGit implements Git
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
