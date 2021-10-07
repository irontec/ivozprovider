<?php

require_once 'Zend/Registry.php';

putenv("APP_ENV=dev");
$_SERVER['APP_ENV'] = getenv('APP_ENV');

require dirname(__DIR__) . '/../rest/platform/config/bootstrap.php';

Symfony\Component\ErrorHandler\Debug::enable();

$kernel = new Kernel('dev', true);
$kernel->boot();

require 'zf.php';
