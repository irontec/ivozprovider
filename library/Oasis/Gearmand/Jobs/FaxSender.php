<?php
namespace Oasis\Gearmand\Jobs;

class FaxSender extends AbstractJob {

    protected $__faxInOut;

    protected $_mainVariables = array(
            '_faxInOut'
    );


    protected $_method = "sendFax";


    public function setFaxInOut($faxInOut)
    {
        $this->_faxInOut = $faxInOut;
        return $this;
    }

    public function getFaxInOut()
    {
        return $this->_faxInOut;
    }

}