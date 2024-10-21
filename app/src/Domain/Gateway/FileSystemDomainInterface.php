<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

use App\Domain\ValueObject\FileVO;

interface FileSystemDomainInterface
{
    public function exists(string $path): bool;

    public function remove(string $path): void;

    /**
     * @return FileVO[]
     */
    public function getFilesInDirectory(string $dirPath): array;

    public function mkdir(string $path, bool $force = false): bool;

    public function getFileContent(string $path): string;
}
