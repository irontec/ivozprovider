<?php
namespace Agi\Action;

class CallForwardAction extends RouterAction
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
        $this->agi->verbose("Processing %s call forward", $cfw->getCallForwardType());
        
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
        
        // Route to destination
        $this->_user            = $cfw->getUser();
        $this->_routeType       = $cfw->getTargetType();
        $this->_routeExtension  = $cfw->getExtension();
        $this->_routeVoiceMail  = $cfw->getVoiceMailUser();
        $this->_routeExternal   = $cfw->getNumberValue();
        $this->route();
    }

    protected function _routeToVoiceMail()
    {
        // Set as diversion number the user extension
        $this->agi->setRedirecting('from-num,i', $this->_user->getExtensionNumber());
        $this->agi->setRedirecting('from-name',  $this->_user->getFullName());

        // Use default route function
        parent::_routeToVoiceMail();
    }

    protected function _routeToExtension()
    {
        // Set as diversion number the user extension
         $this->agi->setRedirecting('from-num,i', $this->_user->getExtensionNumber());
         $this->agi->setRedirecting('from-name',  $this->_user->getFullName());

        // Use default route function
        parent::_routeToExtension();
    }

    protected function _routeToExternal()
    {
        // Set as diversion number the user Outgoing DDI
        $this->agi->setRedirecting('from-num,i', $this->_user->getOutgoingDDINumber());
        $this->agi->setRedirecting('from-name',  $this->_user->getFullName());

        // Use default route function
        parent::_routeToExternal();
    }
}
