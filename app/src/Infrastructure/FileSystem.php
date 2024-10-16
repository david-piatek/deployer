<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Gateway\FileSystem as FileSystemInterface;
use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;

class FileSystem implements FileSystemInterface
{
    private readonly SymfonyFilesystem $fs;

    public function __construct()
    {
        $this->fs = new SymfonyFilesystem();
    }

    public function exists(string $path): bool
    {
        return $this->fs->exists($path);
    }

    public function remove(string $path): bool
    {
        return true;
    }

    public function mkdir(string $path, bool $force = false): bool
    {
        return true;
    }

    public function getFileContent(string $path): string
    {
        return $this->fs->readFile($path);
    }
}
