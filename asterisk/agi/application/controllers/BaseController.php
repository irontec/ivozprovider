<?php

/**
 *
 * @package AGI
 * @subpackage BaseController
 *
 * Generic controller to be used as base for the rest of the
 * controllers.
 * Implementation of basic handlings of initialization and error
 * actions.
 *
 * @class IndexController
 * @brief AGI de entrada de todas las llamadas.
 */
class BaseController extends Zend_Controller_Action
{
    /**
     * @var \Agi_Wrapper
     */
    public $agi;

    public function init()
    {
        // Set agi wrapper for this controller
        $this->agi = new \Agi_Wrapper();
    }

    public function errorAction ()
    {
        $errors = $this->_getParam('error_handler');
        $error = $errors->exception->getTrace();

        if(!empty($error)){
            $error = $error[0];
        }

        $uniqueid = $this->agi->getUniqueId();
        if (isset($error['file'])) {
            $file = $error["file"];
            $line = $error["line"];
        } else {
            $file = "unknown";
            $line = "0";
        }

        $this->_helper->Logger($uniqueid, $file, $line, "LOG_ALERT", $errors->exception->getMessage());
        $this->agi->error("[$file:$line] " . $errors->exception->getMessage());
        $this->agi->hangup();
        exit(1);
    }

    public function getLog ()
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (! $bootstrap->hasResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    }



}