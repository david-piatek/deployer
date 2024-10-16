<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Exception\FileSystemException;
use App\Domain\Gateway\FileSystem as FileSystemInterface;
use App\Domain\ValueObject\DirectoryDataVO;
use Symfony\Component\Finder\Finder;

class FileSystem
{
    private const DATA_FILENAME = 'data.json';
    private const TEMPLATE_DIRNAME = 'templates';

    public function __construct(
        private readonly FileSystemInterface $fs,
    ) {
    }

    public function getFilesContent(string $path): DirectoryDataVO
    {
        $this->checkFileStructure($path);
        $filesContents = [];
        $filesContents['data'] = $this->fs->getFileContent($path.self::DATA_FILENAME);
        $finder = new Finder();
        foreach ($finder->files()->in($path.self::TEMPLATE_DIRNAME) as $fileName) {
            $filesContents['templates'][] = $this->fs->getFileContent($fileName->getPathname());
        }

        return new DirectoryDataVO($filesContents['data'], $filesContents['templates']);
    }

    public function checkFileStructure(string $path): void
    {
        foreach ([$path, $path.self::DATA_FILENAME, $path.self::TEMPLATE_DIRNAME] as $item) {
            if (false === $this->fs->exists($item)) {
                throw new FileSystemException("Not found at $item");
            }
        }

        if (false === $this->fs->exists($path.self::DATA_FILENAME)) {
            throw new FileSystemException("File data not found at $path"); // TODO specify Exception
        }
    }

    public function exists(string $path): bool
    {
        return $this->fs->exists($path);
    }

    public function remove(string $path): bool
    {
        return $this->fs->remove($path);
    }

    public function mkdir(string $path, bool $force = false): bool
    {
        if (false === $this->fs->exists($path) && true === $force) {
            $this->fs->remove($path);
        }

        $this->fs->mkdir($path);

        return true;
    }

    public function getFileContent(string $path): string
    {
        return $this->fs->getFileContent($path);
    }
}
