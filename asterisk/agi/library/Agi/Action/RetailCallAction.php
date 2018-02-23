<?php

namespace Agi\Action;

class RetailCallAction extends RouterAction
{
    protected $_retailAccount;

    protected $_timeout;

    protected $_dialStatus = null;

    protected $_dialContext = 'call-retail';

    protected $_processDialStatus = true;

    public function setRetailAccount($retailAccount)
    {
        $this->_retailAccount = $retailAccount;
        return $this;
    }

    public function setProcessDialStatus($process)
    {
        $this->_processDialStatus = $process;
        return $this;
    }

    public function getDialStatus()
    {
        return $this->_dialStatus;
    }

    public function setTimeout($timeout)
    {
        $this->_timeout = $timeout;
        return $this;
    }

    public function call()
    {
        if (empty($this->_retailAccount)) {
            $this->agi->error("Retail account is not properly defined. Check configuration.");
            return;
        }

        // Local variables to improve readability
        $retailAccount = $this->_retailAccount;

        // Transform destination to retail preferred format
        $number =  $retailAccount->E164ToPreferred($this->agi->getExtension());

        // Some verbose dolan pls
        $this->agi->notice("Preparing call to %s through retail account \e[0;36m%s [retailAccount%d])\e[0m",
                        $number, $retailAccount->getName(), $retailAccount->getId());

        // Check if retail account has call inconditional forwarding enabled
        $cfwSettings = $retailAccount->getEnabledCallForwardSettings("callForwardType='inconditional'");
        foreach ($cfwSettings as $cfwSetting) {
            $cfwAction = new CallForwardRetailAction($this);
            $cfwAction
                ->setCallForward($cfwSetting)
                ->process();
            return;
        }

        // Transform number to account Preferred
        $preferred = $retailAccount->E164ToPreferred($this->agi->getOrigCallerIdNum());
        $this->agi->setCallerIdNum($preferred);

        // Get retail account endpoint
        $endpointName = $retailAccount->getSorcery();

        // Configure Dial options
        $this->_timeout = "";
        $options = ""; // FIXME

        $cfwSettings = $retailAccount->getEnabledCallForwardSettings("callForwardType='noAnswer'");
        foreach ($cfwSettings as $cfwSetting) {
            $this->_timeout = $cfwSetting->getNoAnswerTimeout();
        }

        if ($this->_processDialStatus) {
            // Process Dialstatus after calling this retailAccount (allows call forwards)
            $options .= "g";
        }

        // Call the PSJIP endpoint
        $this->agi->setVariable("DIAL_EXT", $number);
        $this->agi->setVariable("DIAL_DST", "PJSIP/$endpointName");
        $this->agi->setVariable("__DIAL_ENDPOINT", $endpointName);
        $this->agi->setVariable("DIAL_TIMEOUT", $this->_timeout);
        $this->agi->setVariable("DIAL_OPTS", $options);

        // Redirect to the calling dialplan context
        $this->agi->redirect('call-retail', $number);
    }

    public function processDialStatus()
    {
        //! Requested no to parse dialstatus
        if (!$this->_processDialStatus) {
            return;
        }

        if (empty($this->_retailAccount)) {
            $this->agi->error("Retail account is not properly defined. Check configuration.");
            return;
        }

        // Local variables to improve readability
        $retailAccount = $this->_retailAccount;

        // If no dialstatus has been provided, try to get Dial output
        if (empty($this->_dialStatus)) {
            $this->_dialStatus = $this->agi->getVariable("DIALSTATUS");
        }

        // Some output for the asterisk cli
        $this->agi->verbose("Call ended with status %s", $this->_dialStatus);

        // Check Call Forward configuration configured with dialstatus
        switch ($this->_dialStatus) {
            case 'CHANUNAVAIL';
                $this->_processCallForward($retailAccount, 'userNotRegistered');
                break;
            case 'BUSY':
            case 'CONGESTION':
                if (!$this->_processCallForward($retailAccount, 'busy')) {
                    // No busy handler, send response
                    $this->agi->busy();
                }
                break;
            case 'NOANSWER':
                $this->_processCallForward($retailAccount, 'noAnswer');
                break;
            case 'CANCEL':
                // FIXME ??
                $this->agi->hangup(16);
                break;
            default:
                break;
        }
    }

    private function _processCallForward($retailAccount, $type)
    {
        // Process busy Call Forwards
        $cfwSettings = $retailAccount->getEnabledCallForwardSettings("callForwardType='$type'");
        foreach ($cfwSettings as $cfwSetting) {
            $cfwAction = new CallForwardRetailAction($this);
            $cfwAction
                ->setCallForward($cfwSetting)
                ->process();
            return $cfwAction;
        }
        return null;
    }
}
