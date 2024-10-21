<?php

declare(strict_types=1);

namespace Tests\App\Unit\Adapter;

use App\Domain\Gateway\GitDomainInterface;

final class InMemoryGitDomainInterface implements GitDomainInterface
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
