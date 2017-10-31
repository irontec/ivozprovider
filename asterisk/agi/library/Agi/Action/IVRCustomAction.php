<?php

namespace Agi\Action;
use Assert\Assertion;
use Ivoz\Provider\Domain\Model\IvrCustom\IvrCustomInterface;
use Ivoz\Provider\Domain\Model\IvrCustomEntry\IvrCustomEntryInterface;


class IVRCustomAction extends IVRAction
{

    public function process()
    {
        /** @var IvrCustomInterface $ivr */
        $ivr = $this->_ivr;
        Assertion::notNull(
            $ivr,
            "IVRCustom is not properly defined. Check configuration."
        );

        // Some feedback for asterisk cli
        $this->agi->notice("Processing IVRCustom %s [ivrcustom%d]", $ivr->getName(), $ivr->getId());

        // Get IVR all Locutions
        $welcomeLocution = "";
        if (!empty($ivr->getWelcomeLocution())) {
            $welcomeLocution = $ivr->getWelcomeLocution();
        }

        // Play locution and expect user press
        $userPressed = $this->agi->read($welcomeLocution, $ivr->getTimeout(), $ivr->getMaxDigits());
        $this->agi->verbose("IVR: User entered: %s", $userPressed);

        // User prefer Human interaction
        if ($userPressed == "HANGUP") {
            return;
        }

        // User hasn't pressed anything
        if (empty($userPressed)) {
            return $this->processTimeout();
        }

        // Store current IVR data
        $this->agi->setVariable("IVRID", $ivr->getId());
        $this->agi->setVariable("IVRTYPE", 'CUSTOM');

        // Check if the pressed input matches one of the configured extensions
        /** @var IvrCustomEntryInterface[] $entries */
        $entries = $ivr->getEntries();
        foreach ($entries as $entry) {
            // Found a matching entry
            if (preg_match('/' . $entry->getEntry() . '/', $userPressed)) {
                // Entered data matched one of the entries, play success (if any)
                $this->agi->playback($ivr->getSuccessLocution());

                // Play entry success (if any)
                $this->agi->playback($entry->getWelcomeLocution());

                // Route to destination
                $this->_routeType       = $entry->getTargetType();
                $this->_routeExtension  = $entry->getTargetExtension();
                $this->_routeVoiceMail  = $entry->getTargetVoiceMailUser();
                $this->_routeExternal   = $entry->getTargetNumberValue();
                $this->_routeConditionalRoute = $entry->getTargetConditionalRoute();

                // Routed! :)
                return $this->route();
            }
        }

        // If we have reached here, none of the entries have matched
        $this->processError();
    }

}
