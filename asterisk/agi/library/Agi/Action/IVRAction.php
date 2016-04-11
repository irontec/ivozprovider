<?php

namespace Agi\Action;

class IVRAction extends RouterAction
{
    protected $_ivr;

    public function setIVR($ivr)
    {
        $this->_ivr = $ivr;
        return $this;
    }

    public function processTimeout()
    {
        $ivr = $this->_ivr;
        $this->agi->verbose("Processing IVR timeout handler.");

        // Play Timoeut Locution
        $this->agi->playback($ivr->getNoAnswerLocution());

        // Route to destination
        $this->_routeType       = $ivr->getTimeoutTargetType();
        $this->_routeExtension  = $ivr->getTimeoutExtension();
        $this->_routeVoiceMail  = $ivr->getTimeoutVoiceMailUser();
        $this->_routeExternal   = $ivr->getTimeoutNumberValue();
        $this->route();
    }

    public function processError()
    {
        $ivr = $this->_ivr;
        $this->agi->verbose("Processing IVR error handler.");        

        // Play Error Locution
        $this->agi->playback($ivr->getErrorLocution());

        // Route to destination
        $this->_routeType       = $ivr->getErrorTargetType();
        $this->_routeExtension  = $ivr->getErrorExtension();
        $this->_routeVoiceMail  = $ivr->getErrorVoiceMailUser();
        $this->_routeExternal   = $ivr->getErrorNumberValue();
        $this->route();
    }

    /**
     * Overload routeToUser action to send the call to special context
     */
    protected function _routeToUser()
    {
        // Set id variable for postprocessing
        $this->agi->setVariable("IVRID", $this->_ivr->getId());
        
        // Handle Call user route
        $userAction = new UserCallAction($this);
        $userAction
            ->setDialContext('call-ivr')
            ->setTimeout($this->_ivr->getNoAnswerTimeout())
            ->setUser($this->_routeUser)
            ->setProcessDialStatus(true)
            ->call();
    }

    /**
     * Overload roteToExternal to set the company that pays this call
     */
    protected function _routeToExternal()
    {
        // This call to external is paid by the Company :)
        $externalAction = new ExternalCallAction($this);
        $externalAction
            ->setCompany($this->_ivr->getCompany())
            ->setDestination($this->_routeExternal)
            ->process();
    }
}
