<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Gateway\GitDomainInterface;
use CzProject\GitPhp\Git;
use CzProject\GitPhp\GitException;

class GitInfrastructure implements GitDomainInterface
{
    private Git $git;

    public function __construct()
    {
        $this->git = new Git();
    }

    /**
     * @throws GitException
     */
    public function clone(string $url, string $destPath): bool
    {
        $this->git->cloneRepository($destPath, $url);
        dd('clone');

        return true;
    }

    public function push(string $repoName): bool
    {
        return true;
    }
}
