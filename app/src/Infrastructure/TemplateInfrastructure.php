<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Gateway\TemplateDomainInterface as TemplateDomainInterface;
use App\Domain\ValueObject\DataVO;
use Twig\Environment;

class TemplateInfrastructure implements TemplateDomainInterface
{
    public function __construct(
        private readonly Environment $twig,
    ) {
    }

    public function render(string $templateName, DataVO $data): string
    {
        return $this->twig->render($templateName, (array) $data);
        // $finder = new Finder();
        // $finder->in($appTemplatePath)->depth('== 0');
        // foreach ($finder as $file) {
        //     //$content = json_decode( file_get_contents($file));
        //     dump($file->getPathName());
        //
        //     $twig->render($file->getPathName(), ['nom' => "ddd"]);
        //
        //     file_put_contents($absolutePAth,$content);
        //     //  $content = $twig->render('bvlogia.twig', ['nom' => "ddd"]);
        // }
    }
}
