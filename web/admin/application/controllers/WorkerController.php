<?php

class WorkerController extends Zend_Controller_Action
{
    protected $_bootstrap;
    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
        \Iron_Gearman_Manager::setOptions($this->_bootstrap->getOption("gearmand"));
    }

    public function multimediaAction()
    {
        \Iron_Gearman_Manager::runWorker("Multimedia");
    }

    public function xmlrpcAction()
    {
        \Iron_Gearman_Manager::runWorker("Xmlrpc");
    }

    public function xmlrpcdelayedAction()
    {
        \Iron_Gearman_Manager::runWorker("Xmlrpcdelayed");
    }

    public function amiAction()
    {
        \Iron_Gearman_Manager::runWorker("Ami");
    }

    public function tarificatorAction()
    {
        \Iron_Gearman_Manager::runWorker("Tarificator");
    }

    public function invoicerAction()
    {
        \Iron_Gearman_Manager::runWorker("Invoicer");
    }

    public function pricesimporterAction()
    {
        \Iron_Gearman_Manager::runWorker("PricesImporter");
    }
}
