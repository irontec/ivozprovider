<?php

    defined('__DIR__') || define('__DIR__', dirname(__FILE__));


    define('APPLICATION_PATH', realpath(__DIR__ . '/../../application'));

    require_once 'Zend/Loader/Autoloader.php';
    require_once realpath(APPLICATION_PATH . '/../../library/vendor/autoload.php');

    $loader = Zend_Loader_Autoloader::getInstance();

    // we need this custom namespace to load our custom class
    $env = getenv('APPLICATION_ENV');

    defined('APPLICATION_ENV')
     || define('APPLICATION_ENV', (null === $env) ? 'production' : $env);

    // initialize Zend_Application
    $application = new Zend_Application (
        APPLICATION_ENV,
        APPLICATION_PATH . '/configs/application.ini'
    );

    $loader->registerNamespace('Iron_');

//var_dump(get_include_path());
//$paths = explode(":", get_include_path());
//foreach ($paths as $path) {
//    echo "\n\n". realpath($path);
//}
//die();

//     bootstrap and retrive the frontController resource
    $front = $application->getBootstrap()
          ->bootstrap(array('frontController'))
          ->getResource('frontController');



    $request = new Zend_Controller_Request_Simple("index", "dummy", "default");

//     // set front controller options to make everything operational from CLI
    $front->setRequest($request)
       ->setRouter(new Iron_Controller_Router_Cli())
       ->setResponse(new Zend_Controller_Response_Cli())
       ->throwExceptions(true);

    // lets bootstrap our application and enjoy!


    class DummyController extends Zend_Controller_Action
    {
        public function indexAction()
        {
            $this->_helper->viewRenderer->setNoRender(true);
//            $this->_helper->layout()->disableLayout();
        }
    }

    $application->bootstrap()->run();
