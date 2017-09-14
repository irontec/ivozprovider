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

        // Some feedback for asterisk cli
        $this->agi->notice("Processing IVRCustom %s [ivrcustom%d]", $ivr->getName(), $ivr->getId());

        // Get IVR all Locutions
        $welcomLocution = $ivr->getWelcomeLocution();
        if (empty($welcomLocution)) {
            $welcomLocutionFile = "";
        } else {
            $welcomLocutionFile = $welcomLocution->getLocutionPath();
        }

        // Play locution and expect user press
        $userPressed = $this->agi->read($welcomLocutionFile, $ivr->getTimeout(), $ivr->getMaxDigits());
        $this->agi->verbose("IVR: User entered: %s", $userPressed);

        // User prefer Human interaction
        if ($userPressed == "HANGUP") {
            return;
        }

        // User hasn't pressed anything
        if (empty($userPressed)) {
            return $this->processError();
        }

        // Store current IVR data
        $this->agi->setVariable("IVRID", $ivr->getId());
        $this->agi->setVariable("IVRTYPE", 'CUSTOM');

        // Check if the pressed input matches one of the configured extensions
        $entries = $ivr->getIVRCustomEntries();
        foreach ($entries as $entry) {
            // Found a matching entry
            if (preg_match('/' . $entry->getEntry() . '/', $userPressed)) {
                // Entered data matched one of the entries, play success (if any)
                $this->agi->playback($ivr->getSuccessLocution());

                // Play entry success (if any)
                $this->agi->playback($entry->getWelcomeLocution());

                // For extension, use extension routing to apply timeout
                if ($entry->getTargetType() == 'extension') {
                    $extension = $entry->getTargetExtension();
                    // FIXME Routing to extension should be the same as routing to
                    // any other option...
                    // !! Route this IVR using th extension parmaters !!
                    $this->_routeType       = $extension->getRouteType();
                    $this->_routeUser       = $extension->getUser();
                    $this->_routeIVRCommon  = $extension->getIVRCommon();
                    $this->_routeIVRCustom  = $extension->getIVRCustom();
                    $this->_routeHuntGroup  = $extension->getHuntGroup();
                    $this->_routeConference = $extension->getConferenceRoom();
                    $this->_routeExternal   = $extension->getNumberValue();
                    $this->_routeFriend     = $extension->getFriendValue();
                    $this->_routeQueue      = $extension->getQueue();
                    $this->_routeConditionalRoute = $extension->getConditionalRoute();
                } else {
                    // Route to destination
                    $this->_routeType       = $entry->getTargetType();
                    $this->_routeExtension  = $entry->getTargetExtension();
                    $this->_routeVoiceMail  = $entry->getTargetVoiceMailUser();
                    $this->_routeExternal   = $entry->getTargetNumberValue();
                    $this->_routeConditionalRoute = $entry->getTargetConditionalRoute();
                }
                // Routed! :)
                return $this->route();
            }
        }

        // If we have reached here, none of the entries have matched
        $this->processError();
    }

}
