<?php

use Symfony\Component\HttpFoundation\Request;

// require Composer's autoloader
require __DIR__.'/../vendor/autoload.php';

require __DIR__ . '/../src/MicroKernel.php';

$env = getenv('SYMFONY_ENV') ?: 'dev';
$debug = getenv('SYMFONY_DEBUG') !== '0';

$kernel = new MicroKernel($env, $debug, $fastagi);

$request = Request::create($argx['command'], 'GET');

$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
