<?php
namespace App\Infrastructure;

use Symfony\Component\Finder\Finder;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Deployer
 {

    function __construct(string $absolutePAth, array $argv)
    {
        //json path correspond au dossier des template correspondant
        $appName = $argv[1];

        $ConfigPath = $absolutePAth.DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR.$appName.".json";

        $appTemplatePath = $absolutePAth.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$appName ;
        $templatePath = $absolutePAth.DIRECTORY_SEPARATOR.'templates' ;

        $destPath=$absolutePAth.
            DIRECTORY_SEPARATOR.
            ".." .
            DIRECTORY_SEPARATOR.
            "tmp".
            DIRECTORY_SEPARATOR.
            $appName;

        dd( $destPath);




        $loader = new FilesystemLoader($templatePath);
        $twig = new Environment($loader);

        $finder = new Finder();
        $finder->in($appTemplatePath)->depth('== 0');
        foreach ($finder as $file) {
           //$content = json_decode( file_get_contents($file));
            dump($file->getPathName());

          $twig->render($file->getPathName(), ['nom' => "ddd"]);

            file_put_contents($absolutePAth,$content);
            //  $content = $twig->render('bvlogia.twig', ['nom' => "ddd"]);
        }

    }
 }
