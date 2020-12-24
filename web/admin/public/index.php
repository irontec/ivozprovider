<?php
require_once 'Zend/Registry.php';

require dirname(__DIR__).'/../rest/platform/config/bootstrap.php';

$kernel = new Kernel('prod', false);
$kernel->boot();

require 'zf.php';
