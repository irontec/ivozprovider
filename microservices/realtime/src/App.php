<?php

use Services\WsServer;
use Services\Sentinel;
use Symfony\Component\Debug\Debug;

$loader = require __DIR__.'/../vendor/autoload.php';

$env = getenv('SYMFONY_ENV') ?: 'dev';
$debug = getenv('SYMFONY_DEBUG') !== '0' && $env !== 'prod';
if ($debug) {
    Debug::enable();
}
$kernel = new MicroKernel(
    $env,
    $debug
);
$kernel->boot();
$serviceContainer = $kernel->getContainer();

/** @var WsServer $server */
$server = $serviceContainer->get(
    WsServer::class
);

/** @var Sentinel $sentinel */
$sentinel = $serviceContainer->get(Sentinel::class);
$server->start(
    $sentinel,
    $serviceContainer->getParameter('redis_pool_size'),
    $serviceContainer->getParameter('redis_db')
);
