<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Exception\FileSystemException;
use App\Domain\Gateway\FileSystemDomainInterface;
use App\Domain\ValueObject\DirectoryDataVO;

class FileSystemModel
{
    private const DATA_FILENAME = 'data.json';
    private const TEMPLATE_DIRNAME = 'templates';

    public function __construct(
        private readonly FileSystemDomainInterface $fs,
    ) {
    }

    public function getFilesContent(string $path): DirectoryDataVO
    {
        $this->checkFileStructure($path);
        $filesContents = [];
        $filesContents['data'] = $this->fs->getFileContent($path.self::DATA_FILENAME);
        foreach ($this->fs->getFilesInDirectory($path.self::TEMPLATE_DIRNAME) as $file) {
            $filesContents['templates'][] = $file->content;
        }

        return new DirectoryDataVO($filesContents['data'], $filesContents['templates']);
    }

    public function checkFileStructure(string $path): void
    {
        foreach ([$path, $path.self::DATA_FILENAME, $path.self::TEMPLATE_DIRNAME] as $item) {
            if (false === $this->exists($item)) {
                throw new FileSystemException("Not found at $item");
            }
        }

        if (false === $this->exists($path.self::DATA_FILENAME)) {
            throw new FileSystemException("File data not found at $path"); // TODO specify Exception
        }
    }
    
    public function mkdir(string $path, bool $force = false): bool
    {
        if (false === $this->fs->exists($path) && true === $force) {
            $this->remove($path);
        }

        $this->fs->mkdir($path);

        return true;
    }

    private function exists(string $path): bool
    {
        return $this->fs->exists($path);
    }

    private function remove(string $path): void
    {
        $this->fs->remove($path);
    }
}
