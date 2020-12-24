<?php
require_once 'Zend/Registry.php';

require dirname(__DIR__).'/../rest/platform/config/bootstrap.php';

putenv("APPLICATION_ENV=testing");
$kernel = new Kernel('test_e2e', false);
$kernel->boot();

require 'zf.php';
