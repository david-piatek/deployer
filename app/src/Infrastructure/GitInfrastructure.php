<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Gateway\GitDomainInterface;

class GitInfrastructure implements GitDomainInterface
{


    public function clone(string $url, string $destPath): bool
    {
        dd('clone');

        return true;
    }

    public function push(string $repoName): bool
    {
        return true;
    }
}
