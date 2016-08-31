<?php

namespace Agi\Action;

class UserCallAction extends RouterAction
{
    protected $_user;

    protected $_timeout;

    protected $_dialStatus = null;

    protected $_dialContext = 'call-user';

    protected $_allowForwarding = true;

    protected $_processDialStatus = true;


    public function setUser($user)
    {
        $this->_user = $user;
        return $this;
    }

    public function setTimeout($timeout)
    {
        $this->_timeout = $timeout;
        return $this;
    }

    public function setDialContext($context)
    {
        $this->_dialContext = $context;
        return $this;
    }

	public function allowForwarding($allow)
	{
	    $this->_allowForwarding = $allow;
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

  	public function call()
    {
  	    if (empty($this->_user)) {
  	        $this->agi->error("User is not properly defined. Check configuration.");
  	        $this->_dialStatus = "INVALIDARGS";
  	        $this->processDialStatus();
            return;
  	    }

        // Local variables to improve readability
  	    $user = $this->_user;

  	    // Check if user is valid to be called
        if (! $user->getActive()) {
            $this->agi->error("User %s [%d] is not active.", $user->getFullName(), $user->getId());
            $this->_dialStatus = "INVALIDARGS";
            $this->processDialStatus();
            return;
        }

  	    // Check if user has extension configured
  	    $extension = $this->_user->getExtension();
  	    if (empty($extension)) {
            $this->agi->error("User %s [%d] has no extension.", $user->getFullName(), $user->getId());
            $this->_dialStatus = "INVALIDARGS";
            $this->processDialStatus();
            return;
  	    }

  	    // Check if user has terminal configured
  	    $terminal = $this->_user->getTerminal();
  	    if (empty($terminal)) {
            $this->agi->error("User %s [%d] has no terminal.", $user->getFullName(), $user->getId());
            $this->_dialStatus = "CHANUNAVAIL";
            $this->processDialStatus();
            return;
  	    }

        // Some verbose dolan pls
        $this->agi->notice("Preparing call to user %s [user%d] (%s [terminal%d])",
                        $user->getFullName(), $user->getId(),
                        $terminal->getName(), $terminal->getId());

        // Check if user has call forwarding enabled
        if ($this->_allowForwarding) {
            // Process inconditional Call Forwards
            $cfwSettings = $user->getCallForwardSettingsByUser("callForwardType='inconditional'");
            foreach ($cfwSettings as $cfwSetting) {
                $cfwType = $cfwSetting->getCallTypeFilter();
                if ($cfwType == "both" || $cfwType == $this->agi->getCallType()) {
                    $cfwAction = new CallForwardAction($this);
                    $cfwAction
                        ->setCallForward($cfwSetting)
                        ->process();
                    return;
                }
            }
        }

        // User requested peace
        if ($user->getDoNotDisturb()) {
            $this->agi->verbose("User %s [user%s] has DND enabled.", $user->getFullName(), $user->getId());
            $this->_dialStatus = "BUSY";
            $this->processDialStatus();
            return;
        }

        // Check if this user is a boss
        if ($user->getIsBoss() && !$this->_canCallBoss($user, $this->agi->getCallerIdNum())) {
            $this->agi->verbose("Boss can't be disturbed by %s. Calling assistant.", $this->agi->getCallerIdNum());
            // Call the assistant
            $callAction = new UserCallAction($this);
            $callAction
                ->setUser($user->getBossAssistant())
                ->setProcessDialStatus(true)
                ->call();
            return;
        }

        // If there's no timeout
        if (empty($this->_timeout)) {
            // Get the timeout from the call forward
            $cfwSettings = $user->getCallForwardSettingsByUser("callForwardType='noAnswer'");
            foreach ($cfwSettings as $cfwSetting) {
                $cfwType = $cfwSetting->getCallTypeFilter();
                if ($cfwType == "both" || $cfwType == $this->agi->getCallType()) {
                    $this->agi->verbose("Call Forward No answer enabled [callForwardSettings%d]. Setting call timeout.",
                                    $cfwSetting->getId());
                    $this->_timeout = $cfwSetting->getNoAnswerTimeout();
                }
            }
        }

        // Check if user is available before placing the call
        $endpointName = $terminal->getSorcery();
        $devicestate = $this->agi->getDeviceState($endpointName);
        $this->agi->verbose("Terminal %s has DeviceState %s", $endpointName, $devicestate);

        // Avoid placing a call for device in this states
        $unavailableArray = array("UNKNOWN", "INVALID", "UNAVAILABLE");
        if (in_array($devicestate, $unavailableArray)) {
            $this->_dialStatus = "CHANUNAVAIL";
            $this->processDialStatus();
            return;
        }

        // Check if the user can have multiple calls at the same time
        if ($devicestate != "NOT_INUSE" && !$user->getCallWaiting()) {
            $this->_dialStatus = "BUSY";
            $this->processDialStatus();
            return;
        }

        // Configure Dial options
        $timeout = $this->_timeout;
        $options = ""; // FIXME

        // Don't accept forwards SIP redirections for this call
        if (!$this->_allowForwarding) {
            $options .= "i";
        }

        if ($this->_processDialStatus) {
            // Process Dialstatus after calling this user (allows call forwards)
            $options .= "g";
        }

        // Update Called name
        if ($this->agi->getCallType() == "external") {
            // Transfor number to User Preferred
            $preferred = $user->E164ToPreferred($this->agi->getOrigCallerIdNum());
            $this->agi->setCallerIdNum($preferred);
            $this->agi->setCallerIdName("");
        }

        // Call the PSJIP endpoint
        $this->agi->setVariable("DIAL_EXT", $extension->getNumber());
        $this->agi->setVariable("DIAL_DST", "PJSIP/$endpointName");
        $this->agi->setVariable("__DIAL_ENDPOINT", $endpointName);
        $this->agi->setVariable("DIAL_TIMEOUT", $this->_timeout);
        $this->agi->setVariable("DIAL_OPTS", $options);

        // Redirect to the calling dialplan context
        if ($this->_dialContext) {
            $this->agi->redirect($this->_dialContext, $extension->getNumber());
        }
    }

    /**
     * TODO This should be part of user model
     * @param unknown $user
     * @param unknown $source
     */
    private function _canCallBoss($boss, $source)
    {
        // Assistant can allways call its boss
        $assistant = $boss->getBossAssistant();
        if (!empty($assistant)) {
            $assistantext = $assistant->getExtension();
            if (!empty($assistantext) && $assistantext->getNumber() == $source) {
                return 1;
            }
        }

        // Check if boss has whitelisted hosts
        $exceptionRegexp = $boss->getExceptionBoosAssistantRegExp();
        if (empty($exceptionRegexp)) {
            return 0;
        }

        // Check if source matches one of the whitelisted patterns
        if (preg_match("/$exceptionRegexp/", $source) == 1) {
            $this->agi->verbose("%s in in the exception lists of Boss %s.", $source, $boss->getId());
            return 1;
        }

        return 0;
    }

    public function processDialStatus()
    {
        //! Requested no to parse dialo status
        if (!$this->_processDialStatus) {
            return;
        }

        if (empty($this->_user)) {
            $this->agi->error("User is not properly defined. Check configuration.");
            return;
        }

        // Local variables to improve readability
        $user = $this->_user;

        // If no dialstatus has been provided, try to get Dial output
        if (empty($this->_dialStatus)) {
            $this->_dialStatus = $this->agi->getVariable("DIALSTATUS");
        }

        // Some output for the asterisk cli
        $this->agi->verbose("Call ended with status %s", $this->_dialStatus);

        // Check Call Forward configuration configured with dialstatus
        switch ($this->_dialStatus) {
            case 'CHANUNAVAIL';
                $this->_processCallForward($this->_user, 'userNotRegistered');
                break;
            case 'BUSY':
            case 'CONGESTION':
                $this->_processCallForward($this->_user, 'busy');
                break;
            case 'NOANSWER':
                $this->_processCallForward($this->_user, 'noAnswer');
                break;
            case 'CANCEL':
                // FIXME ??
                $this->agi->hangup(16);
                break;
            default:
                break;
        }
    }

    private function _processCallForward($user, $type)
    {
        // Process busy Call Forwards
        $cfwSettings = $user->getCallForwardSettingsByUser("callForwardType='$type'");
        foreach ($cfwSettings as $cfwSetting) {
            $cfwType = $cfwSetting->getCallTypeFilter();
            if ($cfwType == "both" || $cfwType == $this->agi->getCallType()) {
                $cfwAction = new CallForwardAction($this);
                $cfwAction
                    ->setCallForward($cfwSetting)
                    ->process();
                break;
            }
        }
    }

}
