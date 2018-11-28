#!/usr/bin/php
<?php
/**
 *  Provisioning template wrapper
 */
date_default_timezone_set('UTC');

defined('APPLICATION_ENV')
|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

$route = 'web/admin/';

defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../../../' . $route . 'application'));

set_include_path(
    implode(
        PATH_SEPARATOR,
        array(
            realpath(APPLICATION_PATH . '/../../../library'),
            get_include_path(),
        )
    )
);

$loader = require __DIR__ . '/../../../web/rest/platform/app/autoload.php';

/** Zend_Application */
require_once 'Zend/Application.php';

$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap();

$scriptOptions = $application->getOption('import');

$wrapper = new TemplateWrapper($argv[1]);
$wrapper->run();

class TemplateWrapper
{
    public function __construct($datos)
    {
        foreach (unserialize(base64_decode($datos)) as $key => $val) {

            $this->$key = $val;
        }
    }

    public function run()
    {
        error_reporting( error_reporting() & ~E_NOTICE );

?>

