#!/usr/bin/php
<?php

use Symfony\Component\HttpFoundation\Request;

// require Composer's autoloader
require __DIR__ . '/../config/bootstrap.php';

require __DIR__ . '/../src/Kernel.php';

$kernel = new Kernel('prod', false, null);

$request = Request::create('Hints/Generator', 'GET');

$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
