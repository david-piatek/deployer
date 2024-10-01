<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Gateway\FileSystem;
use App\Domain\Gateway\Template;

class DeployCommandHandler
{
    public function __construct(
        private readonly Template $template,
        private readonly FileSystem $fileSystem,
        private readonly string $templatePath,
        private readonly string $tmpPath,
    ) {
    }

    public function handle(DeployCommand $command): void
    {
        $templatePathApp = $this->templatePath.$command->appName;
        $this->fileSystem->unzip(
            srcPath: $this->tmpPath.$command->appName.".zip",
            destPath: $templatePathApp
        );
        dd($templatePathApp);
        foreach ($this->fileSystem->getFiles($templatePathApp) as $file) {
            $this->fileSystem->writeFile(
                filepath: $file,
                content: $this->template->render($file->getPathName(), ['nom' => 'ddd']),
            );
        }

        $this->fileSystem->remove($templatePathApp);
    }
}
