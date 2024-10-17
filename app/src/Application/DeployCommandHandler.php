<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Gateway\DataVOSerializer;
use App\Domain\Gateway\Git;
use App\Domain\Gateway\Template;
use App\Domain\Model\FileSystem;
use App\Domain\ValueObject\DataVO;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

readonly class DeployCommandHandler
{
    public function __construct(
        private Template $template,
        private FileSystem $fs,
        private Git $git,
        private DataVOSerializer $serializer,
        private string $tmpPath,
    ) {
    }

    public function handle(DeployCommand $command): void
    {
        $appName = $command->appName;
        $files = $this->fs->getFilesContent($this->tmpPath.DIRECTORY_SEPARATOR.$appName.DIRECTORY_SEPARATOR);

        $data = $this->serializer->deserialize(
            data: $files->data,
            type: DataVO::class,
            format: JsonEncoder::FORMAT
        );

        $gitAppDiR = $this->tmpPath.DIRECTORY_SEPARATOR.$appName.DIRECTORY_SEPARATOR;

        $this->fs->remove($gitAppDiR);

        $this->fs->remove($this->tmpPath.DIRECTORY_SEPARATOR.$appName.DIRECTORY_SEPARATOR);
        dd($files, $data);

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
