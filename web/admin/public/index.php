<?php
require_once 'Zend/Registry.php';

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../../rest/platform/vendor/autoload.php';

$kernel = new Kernel('prod', false);
$kernel->boot();

require 'zf.php';
