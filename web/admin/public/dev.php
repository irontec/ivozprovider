<?php
require_once 'Zend/Registry.php';

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../../rest/app/autoload.php';
Symfony\Component\Debug\Debug::enable();

$kernel = new AppKernel('dev', true);
$kernel->boot();

\Zend_Registry::set(
    'data_gateway',
    $kernel->getContainer()->get(\Ivoz\Core\Application\Service\DataGateway::class)
);
require 'zf.php';
