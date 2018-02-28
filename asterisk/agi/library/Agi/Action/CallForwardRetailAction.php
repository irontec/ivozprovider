<?php
namespace Agi\Action;

class CallForwardRetailAction extends RouterAction
{
    protected $_maxRedirections = 5;

    protected $_cfw;

    public function setCallForward($cfw)
    {
        $this->_cfw = $cfw;
        return $this;
    }

    public function process()
    {
        if (empty($this->_cfw)) {
            $this->agi->error("CallForward is not properly defined. Check configuration.");
            return;
        }

        // Some CLI information
        $cfw = $this->_cfw;
        $this->agi->notice("Processing %s call forward", $cfw->getCallForwardType());

        /**
         * Set Diversion reason based on current Call Forward settings
         *
         * https://wiki.asterisk.org/wiki/display/AST/Function_REDIRECTING
         */
        switch ($cfw->getCallForwardType()) {
            case 'inconditional':
                $this->agi->setRedirecting('reason,i', 'cfu');
                break;
            case 'noAnswer':
                $this->agi->setRedirecting('reason,i', 'cfnr');
                break;
            case 'busy':
                $this->agi->setRedirecting('reason,i', 'cfb');
                break;
            case 'userNotRegistered':
                $this->agi->setRedirecting('reason,i', 'unavailable');
                break;
        }

        // Avoid Redirection loops
        $count = $this->agi->getRedirecting('count');
        if ($count < $this->_maxRedirections) {
            $this->agi->setRedirecting('count,i', ++$count);
        } else {
            $this->agi->error("Max %d redirection reached. Leaving.", $count);
            $this->agi->hangup(44);
            return;
        }

        // Use Redirecting retail account as caller on following routes
        $this->agi->setChannelCaller($cfw->getRetailAccount());

        // Route to destination
        $this->_routeType       = $cfw->getTargetType();
        $this->_routeExternal   = $cfw->getNumberValue();
        $this->route();
    }

    protected function _routeToExternal()
    {
        // Get Call forward user
        $caller = $this->agi->getChannelCaller();

        // Set as diversion number the user Outgoing DDI
        $this->agi->setRedirecting('from-num', $caller->getOutgoingDDINumber());

        $externalAction = new ExternalRetailCallAction($this);
        $externalAction
            ->setDestination($this->_routeExternal)
            ->process();
    }

    protected function _routeToVoiceMail()
    {
        // Handle voicemail route
        $voicemailAction = new VoiceMailAction($this);
        $voicemailAction
            ->processRetailVoicemail();
    }

}
