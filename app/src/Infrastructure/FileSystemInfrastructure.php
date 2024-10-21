<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Gateway\FileSystemDomainInterface as FileSystemInterface;
use App\Domain\ValueObject\FileVO;
use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;
use Symfony\Component\Finder\Finder;

readonly class FileSystemInfrastructure implements FileSystemInterface
{
    private SymfonyFilesystem $fs;
    private Finder $finder;

    public function __construct()
    {
        $this->fs = new SymfonyFilesystem();
        $this->finder = new Finder();
    }

    public function exists(string $path): bool
    {
        return $this->fs->exists($path);
    }

    public function remove(string $path): void
    {
        $this->fs->remove($path);
    }

    public function mkdir(string $path, bool $force = false): bool
    {
        return true;
    }

    public function getFileContent(string $path): string
    {
        return $this->fs->readFile($path);
    }

    public function getFilesInDirectory(string $dirPath): array
    {
        $files = [];
        foreach ($this->finder->in($dirPath) as $file) {
            $files[] = new FileVO(
                path: $file->getRelativePathname(),
                content: $this->getFileContent($file->getPathname())
            );
        }

        return $files;
    }
}
