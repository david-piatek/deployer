<?php

declare(strict_types=1);

namespace Tests\App\Unit\Adapter;

use App\Domain\Gateway\FileSystemDomainInterface;

final class InMemoryFileSystemDomainInterface implements FileSystemDomainInterface
{
    public function exists(string $path): bool
    {
        return true;
    }

    public function remove(string $path): bool
    {
        return true;
    }

    public function mkdir(string $path, bool $force = false): bool
    {
        return true;
    }
}
