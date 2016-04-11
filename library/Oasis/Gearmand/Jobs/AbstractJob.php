<?php
namespace Oasis\Gearmand\Jobs;

abstract class AbstractJob
{

    // Nombnre de vairables que queremos se serialicen
    protected $_mainVariables = array();

    protected $_method;
    protected $_bootstrap;

    public function setMethod($methodName)
    {
    }

    public function __sleep()
    {
        return $this->_mainVariables;
    }


    public function send()
    {
        $bootstrap = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
        \Iron_Gearman_Manager::setOptions($bootstrap->getOption('gearmand'));

        $gearmandClient = \Iron_Gearman_Manager::getClient();
        $jobHandler = $gearmandClient->doBackground($this->_method, igbinary_serialize($this));
    }
}
