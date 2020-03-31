<?php

use Services\WsServer;
use Model\RedisConf;

$loader = require __DIR__.'/../vendor/autoload.php';

// Redis connection pool max size per worker
// 3 at least because 2 are used for this service itself

define(
    'WORKER_REDIS_POOL_SIZE',
    5
);
define(
    'REDIS_DB',
    1
);

$serverConf = [
    'worker_num' => 1,
];

$sentinelsConfs = [
    new RedisConf(
        'data.ivozprovider.local',
        '26379'
    )
];
// Random priority
shuffle($sentinelsConfs);

$server = new WsServer(
    '0.0.0.0',
    8443,
    $serverConf
);

$server->start(
    $sentinelsConfs,
    WORKER_REDIS_POOL_SIZE,
    REDIS_DB
);
