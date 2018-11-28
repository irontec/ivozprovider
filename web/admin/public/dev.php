<?php
require_once 'Zend/Registry.php';

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../../rest/platform/app/autoload.php';
Symfony\Component\Debug\Debug::enable();

$kernel = new AppKernel('dev', true);
$kernel->boot();

putenv("APPLICATION_ENV=development");
require 'zf.php';
