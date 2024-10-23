<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

use App\Domain\ValueObject\RepoVO;

interface   GitDomainInterface
{
    public function clone(
        string $url,
        string $destPath,
    ): bool;

    public function add(
        array $files,
    ): bool;

    public function push(
        string $repoPath,
    ): bool;
}
