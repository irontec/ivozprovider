<?php
require_once 'Zend/Registry.php';

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../../rest/app/autoload.php';
include_once __DIR__.'/../../rest/var/bootstrap.php.cache';

$kernel = new AppKernel('test_e2e', false);
$kernel->boot();

\Zend_Registry::set(
    'data_gateway',
    $kernel->getContainer()->get('ZfBundle\Services\DataGateway')
);
require 'zf.php';
