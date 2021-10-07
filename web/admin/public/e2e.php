<?php

require_once 'Zend/Registry.php';

putenv("APP_ENV=test_e2e");
$_SERVER['APP_ENV'] = getenv('APP_ENV');

require dirname(__DIR__) . '/../rest/platform/config/bootstrap.php';

$kernel = new Kernel('test_e2e', false);
$kernel->boot();

require 'zf.php';
