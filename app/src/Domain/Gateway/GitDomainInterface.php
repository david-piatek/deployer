<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

use App\Domain\ValueObject\RepoVO;

interface GitDomainInterface
{
    public function clone(
        string $url,
        string $destPath,
    ): RepoVO;

    public function add(
        RepoVO $repo,
        array $files,
    ): RepoVO;

    public function push(
        RepoVO $repo,
    ): RepoVO;
}
