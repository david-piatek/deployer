<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Gateway\Template;

readonly class DeployCommandHandler
{
    public function __construct(
        private Template $template,
    ) {
    }

    public function handle(DeployCommand $command): void
    {
        foreach ($command->templates as $templateName => $template) {
            $this->template->render(
                templateName: $templateName,
                data: $command->data
            );
        }

        // apply template -> write output file tmp
        // git clone
        // rm dir
        // git push
        return;
    }
}
