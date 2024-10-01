<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Gateway\FileSystem as FileSystemDomainInterface;
use Symfony\Component\Finder\Finder;

class FIleSystem implements FileSystemDomainInterface
{
    private Finder $finder;

    public function __construct()
    {
        $this->finder = new Finder();
    }

    /**
     * @return string[]
     */
    public function getFiles(string $dir): array
    {
        /** @var string[] $result */
        $result = $this->finder->in($dir)->depth('== 0');

        return $result;
    }

    public function unzip(string $srcPath, string $destPath): void
    {
        $zip = new \ZipArchive();
        $res = $zip->open($srcPath);
        if (true === $res) {
            $zip->extractTo($destPath);
            $zip->close();
        } else {
            throw new \Exception('Failed to open zip');
        }
    }

    public function writeFile(string $filepath, string $content): void
    {
        // TODO: Implement writeFile() method.
    }

    public function remove(string $path): void
    {
        // TODO: Implement remove() method.
    }
}
