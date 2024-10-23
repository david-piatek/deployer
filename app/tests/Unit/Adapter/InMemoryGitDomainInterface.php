<?php

declare(strict_types=1);

namespace Tests\App\Unit\Adapter;

use App\Domain\Gateway\GitDomainInterface;
use App\Domain\ValueObject\RepoVO;

final class InMemoryGitDomainInterface implements GitDomainInterface
{
    public function clone(string $url, string $destPath): bool
    {
        return true;
    }

    public function add( array $files,): bool
    {
        return true;
    }
    public function push(string $repoPath): bool
    {
        return true;
    }
}
