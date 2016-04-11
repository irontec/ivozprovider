<?php
namespace Oasis\Gearmand\Jobs;

class Invoicer extends AbstractJob {

    protected $_pk = null;

    protected $_mainVariables = array(
            "_pk"
    );


    protected $_method = "invoice";

    public function setPk($pk)
    {
        $this->_pk = $pk;
        return $this;
    }

    public function getPk()
    {
        return $this->_pk;
    }
}