<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Enum\CloneType;
use App\Domain\Exception\GitException;
use App\Domain\Gateway\GitDomainInterface;

readonly class GitModel
{
    public function __construct(
        private FileSystemModel $fileSystem,
        private GitDomainInterface $git,
        private string $personalAccessToken,
    ) {
    }

    public function getConnexionString(string $connexionType, string $gitProvider, string $gitRepoRemotePath): string
    {
        try {
            // TODO move this check in validator
            $cloneType = CloneType::from($connexionType);

            return CloneType::HTTPS->value === $connexionType
                ? $cloneType->connexionPrefix().$this->personalAccessToken.'@'.$gitProvider.$cloneType->separator().$gitRepoRemotePath.'.git'
                : $cloneType->connexionPrefix().$gitProvider.$cloneType->separator().$gitRepoRemotePath.'.git';
        } catch (\Throwable $exception) {
            throw new GitException($exception->getMessage());
        }
    }

    public function clone(string $url, string $destPath)
    {
        $this->fileSystem->remove($destPath);
        sleep(3);
        try {
            $url = "https://oauth2:$this->personalAccessToken@github.com/david-piatek/au_fil_du_fish_deployer.git";
            echo $url;
            $this->git->clone($url, $destPath);
            dd('dd');

            return $this->git->clone($url, $destPath);
        } catch (\Throwable $exception) {
            throw new GitException($exception->getMessage());
        }
    }

    public function push(string $repoName): void
    {
        try {
            $this->git->push($repoName);
        } catch (\Throwable $exception) {
            throw new GitException($exception->getMessage());
        }
    }
}
