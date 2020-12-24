<?php

require_once 'Zend/Registry.php';

require dirname(__DIR__).'/../rest/platform/config/bootstrap.php';

Symfony\Component\ErrorHandler\Debug::enable();

$kernel = new Kernel('dev', true);
$kernel->boot();

putenv("APP_ENV=development");
require 'zf.php';
