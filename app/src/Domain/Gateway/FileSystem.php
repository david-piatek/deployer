<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

interface FileSystem
{
    public function exists(string $path): bool;

    public function remove(string $path): bool;

    public function mkdir(string $path, bool $force = false): bool;

    public function getFileContent(string $path): string;
}
