<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Exception\TemplatingException;
use App\Domain\Gateway\DataVOSerializerDomainInterface;
use App\Domain\Gateway\TemplateDomainInterface;
use App\Domain\Model\FileSystemModel;
use App\Domain\Model\GitModel;
use App\Domain\ValueObject\DataVO;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

readonly class DeployCommandHandler
{
    public function __construct(
        private TemplateDomainInterface $template,
        private FileSystemModel $fs,
        private GitModel $git,
        private DataVOSerializerDomainInterface $serializer,
        private string $tmpPath,
        private string $gitDiR,
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

        $this->git->clone($data->gitRepoUrl, $this->gitDiR);

        // git clone https://${REPO_ACCESS_TOKEN}@github.com/david-piatek/au_fil_du_fish_deployer.git ${ROOT_PATH}/../deployer
        // rm -rf  ${dest_path} || true;
        // mkdir -p  ${dest_path} || true;

        foreach ($files->templates as $template) {
            try{
                $this->template->render(
                    templateName: $template->name,
                    data: $data
                );
            } catch (\Exception $exception) {
                throw new TemplatingException($template->name. " : ".$exception->getMessage() );
            }
        }
        // cd ${dest_path}
        // git add .
        // git commit -m "Upgrade by ${APP_NAME} to ${DOCKER_TAG} ${EMOJI}"

        $this->git->push($data->appName);
    }
}
