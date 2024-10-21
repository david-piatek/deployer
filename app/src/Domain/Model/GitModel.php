<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Exception\GitException;
use App\Domain\Gateway\GitDomainInterface;

readonly class GitModel
{
    public function __construct(
        private FileSystemModel $fileSystem,
        private GitDomainInterface $git,
    ) {
    }

    public function clone(string $url, string $destPath)
    {
        $this->fileSystem->remove($destPath);
        try {
            $this->git->clone($url, $destPath);

        }catch (\Throwable $exception){
            throw new GitException($exception->getMessage());
        }

    }

    public function push(string $repoName): bool
    {
        return $this->git->push($repoName);
    }
}
