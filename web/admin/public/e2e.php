<?php
require_once 'Zend/Registry.php';

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../../rest/platform/vendor/autoload.php';

putenv("APPLICATION_ENV=testing");
$kernel = new Kernel('test_e2e', false);
$kernel->boot();

require 'zf.php';
