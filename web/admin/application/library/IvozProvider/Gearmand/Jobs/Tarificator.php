<?php
namespace IvozProvider\Gearmand\Jobs;

class Tarificator extends AbstractJob {

    protected $_pks = null;

    protected $_mainVariables = array(
            "_pks"
    );


    protected $_method = "tarificateCalls";

    public function setPks($pks)
    {
        $this->_pks = $pks;
        return $this;
    }

    public function getPks()
    {
        return $this->_pks;
    }
}