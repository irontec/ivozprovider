<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initLang()
	{
	}

	protected function _initControllerHelpers()
	{
	}

	protected function _initErrorHandler ()
	{
		$frontcontroller =  Zend_Controller_Front::getInstance();
		$frontcontroller->throwExceptions( false );

		$frontcontroller->registerPlugin(new Zend_Controller_Plugin_ErrorHandler(
				array(
						'module'     => 'default',
						'controller' => 'base',
						'action'     => 'error'
				)));

		set_error_handler(array($this, 'warningToException'));
	}

	function warningToException ($type, $errMsg, $errFile, $errLine)
	{
		throw new Exception($errMsg);
	}

}

