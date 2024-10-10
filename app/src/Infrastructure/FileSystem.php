<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Gateway\FileSystem as FileSystemInterface;

class FileSystem implements FileSystemInterface
{
    public function exists(string $path): bool
    {
        return true;
    }
}
