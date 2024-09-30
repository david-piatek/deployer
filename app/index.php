<?php
require __DIR__ . '/vendor/autoload.php';

use App\Infrastructure\Deployer;

new Deployer(
    absolutePAth: __DIR__,
    argv:         $argv
);
