<?php

use Symfony\Component\HttpFoundation\Request;

// require Composer's autoloader
require __DIR__.'/../config/bootstrap.php';

require __DIR__ . '/../src/Kernel.php';

$env = getenv('APP_ENV') ?: 'dev';
$debug = getenv('SYMFONY_DEBUG') !== '0';

$kernel = new Kernel($env, $debug, $fastagi);

$request = Request::create($argx['command'], 'GET');

$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
