<?php

namespace Agi\Action;

class IVRCustomAction extends IVRAction
{

    public function process()
    {
        $ivr = $this->_ivr;

        if (empty($ivr)) {
            $this->agi->error("IVRCustom is not properly defined. Check configuration.");
            return;
        }

        // Get IVR all Locutions
        $welcomLocution = $ivr->getWelcomeLocution();
        if (empty($welcomLocution)) {
            // DIXME ??
            $welcomLocutionFile = '/var/lib/asterisk/sounds/en/if-u-know-ext-dial';
        } else {
            $welcomLocutionFile = $welcomLocution->getLocutionPath();
        }

        // Play locution and expect user press
        $userPressed = $this->agi->read($welcomLocutionFile, $ivr->getTimeout());
        $this->agi->verbose("IVR: User entered: %s", $userPressed);

        // User prefer Human interaction
        if ($userPressed == "HANGUP") {
            return;
        }

        // User hasn't pressed anything
        if (empty($userPressed)) {
            return $this->processError();
        }

        // Check if the pressed input matches one of the configured extensions
        $entries = $ivr->getIVRCustomEntries();
        foreach ($entries as $entry) {
            // Found a matching entry
            if ($userPressed == $entry->getEntry()) {
                // For extension, use extension routing to apply timeout
                if ($entry->getTargetType() == 'extension') {
                    $extension = $entry->getTargetExtension();
                    // !! Route this IVR using th extension parmaters !!
                    $this->_routeType       = $extension->getRouteType();
                    $this->_routeUser       = $extension->getUser();
                    $this->_routeIVRCommon  = $extension->getIVRCommon();
                    $this->_routeIVRCustom  = $extension->getIVRCustom();
                    $this->_routeHuntGroup  = $extension->getHuntGroup();
                } else {
                    // Route to destination
                    $this->_routeType       = $entry->getTargetType();
                    $this->_routeExtension  = $entry->getTargetExtension();
                    $this->_routeVoiceMail  = $entry->getTargetNumber();
                    $this->_routeExternal   = $entry->getTargetVoiceMailUser();
                }
                // Routed! :)
                return $this->route();
            }
        }

        // If we have reached here, none of the entries have matched
        $this->processError();
    }

}
