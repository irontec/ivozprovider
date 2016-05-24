<?php

use Crada\Apidoc\Builder;
use Crada\Apidoc\Exception;

class ApidocController extends Zend_Controller_Action
{

    public function init()
    {

        /**
         * Initialize action controller here
         */
        if (isset($_SERVER['REMOTE_ADDR'])) {
            print('Command Line Only!');
            exit(1);
        }

        $this->_helper->viewRenderer->setNoRender();

    }

    public function indexAction()
    {

        $moduleControllerPath = APPLICATION_PATH . '/modules/rest/controllers/';

        $classes = array();

        foreach (glob($moduleControllerPath . "*Controller.php") as $file) {
            include_once  $file;
            $classes[] = "Rest_" . basename($file, ".php");
        }

        $outputDir  = APPLICATION_PATH . '/../public/apidocs';
        $outputFile = 'index.html';

        try {

            $builder = new Builder($classes, $outputDir, $outputFile);
            $builder->generate();

        } catch (Exception $e) {

            echo 'There was an error generating the documentation: ', $e->getMessage();

        }

        echo "Done\n";
        exit(0);

    }

}