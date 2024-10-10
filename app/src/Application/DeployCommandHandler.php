<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Exception\NoTemplateException;
use App\Domain\Exception\TemplateNotFoundException;
use App\Domain\Gateway\FileSystem;
use App\Domain\Gateway\Git;
use App\Domain\Gateway\Template;

readonly class DeployCommandHandler
{
    public function __construct(
        private Template $template,
        private FileSystem $fs,
        private Git $git,
        private string $tmpPath,
    ) {
    }

    public function handle(DeployCommand $command): void
    {
        $data = $command->data;
        $templates = $command->templates;
        if (empty($templates)) {
            throw new NoTemplateException();
        }

        $destPat = 'toto';
        $repoPath = $this->tmpPath;
        $tmpDestPath = $this->tmpPath;

        // rm if $destPat exist
        // rm if $tmpDestPat exist

        // rm -rf "${ROOT_PATH}/../deployer"
        // git clone https://${REPO_ACCESS_TOKEN}@github.com/david-piatek/au_fil_du_fish_deployer.git ${ROOT_PATH}/../deployer
        // rm -rf  ${dest_path} || true;
        // mkdir -p  ${dest_path} || true;

        $this->git->clone($data->appName, $tmpDestPath);
        foreach ($command->templates as $templateName => $template) {
            if ($this->fs->exists($template)) {
                $this->template->render(
                    templateName: "$templateName",
                    data: $command->data
                );
            } else {
                throw new TemplateNotFoundException($template);
            }
        }
        // cd ${dest_path}
        // git add .
        // git commit -m "Upgrade by ${APP_NAME} to ${DOCKER_TAG} ${EMOJI}"

        $this->git->push($data->appName);
    }
}
