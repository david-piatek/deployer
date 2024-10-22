<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Gateway\GitDomainInterface;
use App\Domain\ValueObject\RepoVO;
use CzProject\GitPhp\Git;
use CzProject\GitPhp\GitException;

class GitInfrastructure implements GitDomainInterface
{
    private Git $git;

    public function __construct()
    {
        // https://github.com/czproject/git-php
        $this->git = new Git();
    }

    /**
     * @throws GitException
     */
    public function clone(string $url, string $destPath): RepoVO
    {
        $repo = $this->git->cloneRepository($url, $destPath);
        $repo = new RepoVO();
        // map repo lib to repo in domain
        dd('clone');

        //         return repoDomain;
        return $repo;
    }

    public function add(RepoVO $repo, array $files): RepoVO
    {
        return true;
    }

    // public function push(repoDomain $repo): bool
    public function push(RepoVO $repo): RepoVO
    {
        return true;
    }
}
