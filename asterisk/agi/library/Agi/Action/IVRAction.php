<?php

namespace Agi\Action;

class IVRAction extends RouterAction
{
    /**
     * @var \Ivoz\Provider\Domain\Model\IvrCommon\IvrCommonInterface
     */
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
        $this->_routeExternal   = $ivr->getTimeoutNumberValueE164();
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
        $this->_routeExternal   = $ivr->getErrorNumberValueE164();
        $this->route();
    }

    /**
     * Overload routeToUser action to send the call to special context
     */
    protected function _routeToUser()
    {
        // Handle Call user route
        $userAction = new UserCallAction($this);
        $userAction
            ->setDialContext('call-ivr')
            ->setTimeout($this->_ivr->getNoAnswerTimeout())
            ->setUser($this->_routeUser)
            ->setProcessDialStatus(true)
            ->call();
    }
}
