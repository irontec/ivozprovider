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
        $this->agi->verbose("Processing IVR no input handler.");

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
}
