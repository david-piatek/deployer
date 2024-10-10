<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

interface FileSystem
{
    public function exists(string $path): bool;
}
