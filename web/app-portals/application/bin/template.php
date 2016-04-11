#!/usr/bin/php
<?php
/**
 *  * Script Para importar las BBDD de labayru
 */
date_default_timezone_set('UTC');

// Define application environment
defined('APPLICATION_ENV')
|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Define path to application directory
$route = '';
if ( APPLICATION_ENV != 'localdev'){
    $route =  'app-portals/';
}
defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../../../' . $route . 'application'));


// Ensure library/ is on include_path
set_include_path(
    implode(
        PATH_SEPARATOR,
        array(
            realpath(APPLICATION_PATH . '/../../../library'),
            get_include_path(),
        )
    )
);

/** Zend_Application */
require_once 'Zend/Application.php';

//Los argumentos pasados se controlan mediante el array $argv.

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap();

//Para leer opciones de applicantion.ini
//$Option = $application->getOption('option');
//

$scriptOptions = $application->getOption('import');

$miClase = new miclase($argv[1]);
$miClase->run();

////////////HASTA AQUI EL TEMPLANTE//////////////////////

class miclase
{
    
    public function __construct($datos) 
    {
        foreach (unserialize(base64_decode($datos)) as $key => $val) {
            
            $this->$key = $val;
        }
    }
    
    public function run()
    {
        
        ?>
        
       