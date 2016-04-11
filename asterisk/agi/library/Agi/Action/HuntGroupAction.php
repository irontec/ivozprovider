<?php

namespace Agi\Action;

class HuntGroupAction extends RouterAction
{
    protected $_huntgroup;

    public function setHuntGroup($huntgroup)
    {
        $this->_huntgroup = $huntgroup;
        return $this;
    }

    public function process()
    {
        // Validate Action
        if (empty($this->_huntgroup)) {
            $this->agi->error("HuntGroup is not properly defined. Check configuration.");
            return;
        }

        // Process different huntGroups types
        $type = $this->_huntgroup->getStrategy();
        $this->agi->verbose("Processing %s HuntGroup.", $type);
        switch ($type) {
            case 'ringAll':
                $this->_processRingAll();
                break;
            case 'linear':
            case 'roundRobin':
            case 'random':
                $this->_processRest();
                break;
            default:
                $this->agi->error("Huntgroup %s has no strategy.", $this->_huntgroup->getName());
                return;
        }
    }

    public function callUser()
    {
        // Extract next extension to be called
        $callExtensions = explode(';', $this->agi->getVariable("HG_EXTLIST"));
        $callTimeouts   = explode(';', $this->agi->getVariable("HG_TIMEOUTLIST"));

        // Next to be called
        $firstExt = array_shift($callExtensions);
        $firstTimeout = array_shift($callTimeouts);

        // All user called!
        if (empty($firstExt))
            return;

        $company = $this->_huntgroup->getCompany();
        $extension = $company->getExtension($firstExt);
        $user = $extension->getUser();

        // Validate the call to this user
        $userAction = new UserCallAction($this);
        $userAction
            ->setUser($user)
            ->setTimeout($firstTimeout)
            ->setDialContext('call-huntgroup')
            ->allowForwading(false)
            ->setProcessDialStatus(false)
            ->call();

        //  If call has not been redirected to context, process next
        $dialStatus = $userAction->getDialStatus();
        if (!empty($dialStatus)) {
            $this->agi->setVariable("DIALSTATUS", $dialStatus);
            $this->agi->verbose("%s (%s) not dialed (%s). Skipping.",
                            $user->getFullName(), $user->getId(), $dialStatus);
            $this->processHuntgroupStatus();
        }
    }

    public function processHuntgroupStatus()
    {
        // Local variables to improve readability
        $huntGroup = $this->_huntgroup;

        // No post-process for RingAll huntgroups
        if ($huntGroup->getStrategy() == 'ringAll')
            return;

        // User didn't picket up
        $dialStatus = $this->agi->getVariable("DIALSTATUS");
        if ($dialStatus == "ANSWER")
            return;

        // Check pending calls
        $callExtensions = explode(';', $this->agi->getVariable("HG_EXTLIST"));
        $callTimeouts   = explode(';', $this->agi->getVariable("HG_TIMEOUTLIST"));

        // Get last called extension
        $calledExt = array_shift($callExtensions);
        $calledTimeout = array_shift($callTimeouts);

        // Push again the interface to the back of the list
        if ($huntGroup->getStrategy() == 'roundRobin') {
            array_push($callExtensions, $calledExt);
            array_push($callTimeouts, $calledTimeout);

            // At least one can answer this call
            if ($dialStatus == "NOANSWER") {
                $this->agi->setVariable("HG_TRIES", 0);
            } else {
                // Count not available users
                $tries = $this->agi->getVariable("HG_TRIES");
                $this->agi->setVariable("HG_TRIES", ++$tries);

                // Everyone has rejected the hungroup call....
                if ($tries == count($callExtensions)) {
                    $this->agi->verbose("Noone is available to receive this call..");
                    $this->agi->busy();
                    return;
                }
            }
        }

        // Update pending extensions
        $this->agi->setVariable("HG_EXTLIST", join($callExtensions,';'));
        $this->agi->setVariable("HG_TIMEOUTLIST", join($callTimeouts,';'));

        // Call user!
        $this->callUser();
    }

    private function _processRingAll()
    {
        // Local variables to improve readability
        $huntGroup = $this->_huntgroup;

        // Get HuntGroup data
        $huntGroupUsers = $huntGroup->getHuntGroupUsersArray();
        $timeout = $huntGroup->getRingAllTimeout();

        // Check huntgroup users
        $callInterfaces = array();
        foreach ($huntGroupUsers as $user) {
            $terminal = $user->getTerminal();
            if (empty($terminal)) {
                $this->agi->error("Skipping user %s without terminal.", $user->getId());
                continue;
            }
            array_push($callInterfaces, "PJSIP/" . $terminal->getName());
        }

        // Anyone is available?
        if (empty($callInterfaces)) {
            $this->agi->verbose("Hungroup is empty or users are invalid.");
            return;
        }

        // Call everyone
        $this->agi->setVariable("HG_ID", $huntGroup->getId());
        $this->agi->setVariable("DIAL_DST", join($callInterfaces, '&'));
        $this->agi->setVariable("DIAL_TIMEOUT", $huntGroup->getRingAllTimeout());
        $this->agi->redirect('call-huntgroup');
    }

    private function _processRest()
    {
        // Local variables to improve readability
        $huntGroup = $this->_huntgroup;

        // Get HuntGroup data
        $huntGroupEntries = $huntGroup->getHuntGroupsRelUsers(null, "priority asc");

        // Shuffle entries in random huntgroups
        if ($huntGroup->getStrategy() == 'random') {
            shuffle($huntGroupEntries);
        }

        // Check huntgroup users
        $callExtensions = array();
        $callTimeouts = array();
        foreach ($huntGroupEntries as $entry) {
            // Get entry user
            $user = $entry->getUser();

            if (empty($user->getExtensionNumber())) {
                $this->agi->error("Skipping user %s without extension.", $user->getId());
                continue;
            }

            array_push($callExtensions, $user->getExtensionNumber());
            array_push($callTimeouts, $entry->getTimeoutTime());
        }
        
        // Anyone is available?
        if (empty($callExtensions)) {
            $this->agi->verbose("Hungroup is empty or users are invalid.");
            return;
        }

        $this->agi->setVariable("HG_ID", $huntGroup->getId());
        $this->agi->setVariable("HG_EXTLIST", join($callExtensions,';'));
        $this->agi->setVariable("HG_TIMEOUTLIST", join($callTimeouts,';'));

        // Start calling the Et user
        $this->callUser();
    }

}
