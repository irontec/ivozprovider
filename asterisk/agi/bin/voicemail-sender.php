#!/usr/bin/php
<?php

use Symfony\Component\HttpFoundation\Request;

// require Composer's autoloader
require __DIR__.'/../vendor/autoload.php';

require __DIR__ . '/../src/MicroKernel.php';

$kernel = new MicroKernel('prod', false, null);

$request = Request::create('voicemail/sender', 'GET');

$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
