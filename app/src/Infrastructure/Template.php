<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Template as TemplateDomainInterface;
use Symfony\Component\Finder\Finder;
use Twig\Environment;

class Template implements TemplateDomainInterface
{
    public function __construct(
        private readonly Environment $twig,
    ) {
    }

    /**
     * @param array<mixed> $context
     */
    public function render(string $filePath, array $context = []): string
    {
        return $this->twig->render($filePath, $context);
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
