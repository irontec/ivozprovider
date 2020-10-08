<?php
require_once 'Zend/Registry.php';

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../../rest/platform/vendor/autoload.php';
use Symfony\Component\ErrorHandler\Debug::enable();

$kernel = new Kernel('dev', true);
$kernel->boot();

putenv("APP_ENV=development");
require 'zf.php';
