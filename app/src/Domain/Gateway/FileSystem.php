<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

interface FileSystem
{
    public function getFiles(string $dir): \Countable;

    public function unzip(string $srcPath, string $destPath): void;

    public function writeFile(string $filepath, string $content): void;

    public function remove(string $path): void;
}
