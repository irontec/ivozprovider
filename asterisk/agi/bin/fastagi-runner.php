<?php

use Symfony\Component\HttpFoundation\Request;

// require Composer's autoloader
require __DIR__.'/../vendor/autoload.php';

require __DIR__ . '/../app/MicroKernel.php';

$kernel = new MicroKernel('prod', false, $fastagi);

$request = Request::create($argx['command'], 'GET');

$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
