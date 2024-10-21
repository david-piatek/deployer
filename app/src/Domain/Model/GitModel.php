<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Exception\FileSystemException;
use App\Domain\Gateway\FileSystemDomainInterface as FileSystemInterface;
use App\Domain\Gateway\GitDomainInterface;
use App\Domain\ValueObject\DirectoryDataVO;

readonly class GitModel
{

    public function __construct(
        private FileSystemModel    $fileSystem,
        private GitDomainInterface $git,
    ){}
    public function clone(string $url, string $destPath,): bool
    {
        $this->fileSystem->remove($destPath);
        $this->git->clone($url, $destPath);

        return true;
    }

    public function push(string $repoName,): bool
    {
        return $this->git->push($repoName);

    }
}
