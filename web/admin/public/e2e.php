<?php
require_once 'Zend/Registry.php';

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../../rest/platform/app/autoload.php';
include_once __DIR__.'/../../rest/platform/var/bootstrap.php.cache';

putenv("APPLICATION_ENV=testing");
$kernel = new AppKernel('test_e2e', false);
$kernel->boot();

require 'zf.php';
