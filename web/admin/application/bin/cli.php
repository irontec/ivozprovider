#!/usr/bin/php
<?php

require_once 'Zend/Registry.php';

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__ . '/../../../../web/rest/platform/app/autoload.php';
include_once __DIR__.'/../../../../web/rest/var/bootstrap.php.cache';

$kernel = new AppKernel('prod', false);
$kernel->boot();

\Zend_Registry::set(
    'data_gateway',
    $kernel->getContainer()->get(\Ivoz\Core\Application\Service\DataGateway::class)
);

require_once 'Zend/Registry.php';

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__ . '/../../../../web/rest/platform/app/autoload.php';

include_once __DIR__.'/../../../../web/rest/var/bootstrap.php.cache';

$kernel = new AppKernel('prod', false);
$kernel->boot();

\Zend_Registry::set(
    'data_gateway',
    $kernel->getContainer()->get(\Ivoz\Core\Application\Service\DataGateway::class)
);

defined('__DIR__') || define('__DIR__', dirname(__FILE__));

define('APPLICATION_PATH', realpath(__DIR__ . '/../'));

    require_once 'Zend/Loader/Autoloader.php';
    require_once realpath(APPLICATION_PATH . '/../../../library/vendor/autoload.php');


    $loader = Zend_Loader_Autoloader::getInstance();

    // we need this custom namespace to load our custom class

    $getopt = new Zend_Console_Getopt(array(
        'action|a=s' => 'action to perform in format of "module/controller/action/param1/param2/param3/.."',
        'env|e-s'    => 'defines application environment (defaults to "production")',
        'help|h'     => 'displays usage information',
    ));

    try {
        $getopt->parse();
    } catch (Zend_Console_Getopt_Exception $e) {
        // Bad options passed: report usage
        echo $e->getUsageMessage();
        return false;
    }

    // show help message in case it was requested or params were incorrect (module, controller and action)
    if ($getopt->getOption('h') || !$getopt->getOption('a')) {
        echo $getopt->getUsageMessage();
        return true;
    }

    // initialize values based on presence or absence of CLI options
    $env      = $getopt->getOption('e');
    defined('APPLICATION_ENV')
     || define('APPLICATION_ENV', (null === $env) ? 'production' : $env);


    // initialize Zend_Application
    $application = new Zend_Application (
        APPLICATION_ENV,
        APPLICATION_PATH . '/configs/application.ini'
    );

    $loader->registerNamespace('Iron_');
    // bootstrap and retrive the frontController resource
    $front = $application->getBootstrap()
          ->bootstrap('frontController')
          ->getResource('frontController');

    $params = array_reverse(explode('/', $getopt->getOption('a')));
    $module = array_pop($params);
    $controller = array_pop($params);
    $action = array_pop($params);

    $reqParams = array();

    if (sizeof($params) % 2 == 0) {
        do {
            $key = array_pop($params);
            $value = array_pop($params);
            $reqParams[$key] = $value;
        } while (sizeof($params) > 1);
    }

    $request = new Zend_Controller_Request_Simple($action, $controller, $module, $reqParams);

    // set front controller options to make everything operational from CLI
    $front->setRequest($request)
       ->setResponse(new Zend_Controller_Response_Cli())
       ->setRouter(new Iron_Controller_Router_Cli())
       ->throwExceptions(true);

    // lets bootstrap our application and enjoy!
    $application->bootstrap()
       ->run();
?>
