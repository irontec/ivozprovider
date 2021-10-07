<?php

use Services\WsServer;
use Services\Sentinel;
use Symfony\Component\ErrorHandler\Debug;

require __DIR__ . '/../config/bootstrap.php';

$env = getenv('APP_ENV') ?: 'dev';
$debug = getenv('SYMFONY_DEBUG') !== '0' && $env !== 'prod';
if ($debug) {
    Debug::enable();
}
$kernel = new Kernel(
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
