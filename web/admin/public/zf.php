<?php

\Zend_Registry::set(
    'data_gateway',
    $kernel->getContainer()->get(\Ivoz\Core\Application\Service\DataGateway::class)
);
\Zend_Registry::set(
    'rates_importer_job',
    $kernel->getContainer()->get(Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\RatesImporter::class)
);
\Zend_Registry::set(
    'logger',
    $kernel->getContainer()->get('monolog.logger.provisioning')
);
\Zend_Registry::set(
    'container',
    $kernel->getContainer()
);



// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

// Ensure library/ is on include_path
/** @todo review this carefully */
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

$GLOBALS['sf'] = true;
$application->bootstrap()
            ->run();
