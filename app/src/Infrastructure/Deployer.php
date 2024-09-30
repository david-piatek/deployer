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
        $appTConfigPath = $absolutePAth.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$appName;

        $content = json_decode( file_get_contents($appTConfigPath));

dd($content);




        $loader = new FilesystemLoader(__DIR__ .DIRECTORY_SEPARATOR. '/templates'.DIRECTORY_SEPARATOR. $appName);

        $twig = new Environment($loader);

        $finder = new Finder();
        $dir = __DIR__ .DIRECTORY_SEPARATOR. 'templates';

        $finder->in($dir)->depth('== 0');
        foreach ($finder as $file) {

            echo $twig->render($file, ['nom' => "ddd"]);

            //file_put_contents("toto",$content);
            //  $content = $twig->render('bvlogia.twig', ['nom' => "ddd"]);
        }

    }
 }
