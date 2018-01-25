<?php
namespace IvozProvider\Gearmand\Jobs;

class Pricesimporter extends AbstractJob {

    protected $_parmas = null;

    protected $_mainVariables = array(
            "_params"
    );


    protected $_method = "importPrices";

    public function setParams($params)
    {
        $this->_params = $params;
        return $this;
    }

    public function getParams()
    {
        return $this->_params;
    }
}
