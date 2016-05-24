#!/usr/bin/php
<?php

    defined('__DIR__') || define('__DIR__', dirname(__FILE__));

    defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
    define('APPLICATION_CLI', true);

    set_include_path(
        implode(
            PATH_SEPARATOR,
            array(
                realpath(APPLICATION_PATH . '/../library'),
                get_include_path(),
            )
        )
    );

    /** Composer **/
    require_once __DIR__ . '/../library/Composer/vendor/autoload.php';

    require_once 'Zend/Loader/Autoloader.php';
    $loader = Zend_Loader_Autoloader::getInstance();

    // we need this custom namespace to load our custom class
    $loader->registerNamespace('IvozProvider_');

    $getopt = new Zend_Console_Getopt(
        array(
        'action|a=s' => 'action to perform in format of "module/controller/action/param1/param2/param3/.."',
        'env|e-s'    => 'defines application environment (defaults to "production")',
        'help|h'     => 'displays usage information',
        )
    );

    try {
        $getopt->parse();
    } catch (Zend_Console_Getopt_Exception $e) {
        // Bad options passed: report usage
        echo $e->getUsageMessage();
        return false;
    }

    /**
     * show help message in case it was requested or params were incorrect (module, controller and action)
     */
    if ($getopt->getOption('h') || !$getopt->getOption('a')) {
        echo $getopt->getUsageMessage();
        return true;
    }

    /**
     * initialize values based on presence or absence of CLI options
     */
    $env      = $getopt->getOption('e');
    defined('APPLICATION_ENV')
     || define('APPLICATION_ENV', (null === $env) ? 'cli' : $env);


    /**
     * initialize Zend_Application
     */
    $application = new Zend_Application(
        APPLICATION_ENV,
        APPLICATION_PATH . '/configs/application.ini'
    );

    /**
     * bootstrap and retrive the frontController resource
     */
    $front = $application->getBootstrap()
          ->bootstrap('frontController')
          ->getResource('frontController');

    $params = array_reverse(explode('/', $getopt->getOption('a')));
    $module = array_pop($params);
    $controller = array_pop($params);
    $action = array_pop($params);
    $request = new Zend_Controller_Request_Simple($action, $controller, $module);

    /**
     * set front controller options to make everything operational from CLI
     */
    $front->setRequest($request)
       ->setResponse(new Zend_Controller_Response_Cli())
       ->setRouter(new Iron_Controller_Router_Cli())
       ->throwExceptions(true);

    /**
     * lets bootstrap our application and enjoy!
     */
    $application->bootstrap()->run();
