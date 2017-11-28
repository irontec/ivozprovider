<?php

namespace Agi\Action;

use Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface;
use Assert\Assertion;
use Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface;

class IVRAction extends RouterAction
{
    /**
     * @var \Ivoz\Provider\Domain\Model\Ivr\IvrInterface
     */
    protected $_ivr;

    public function setIVR($ivr)
    {
        $this->_ivr = $ivr;
        return $this;
    }

    public function process()
    {
        $ivr = $this->_ivr;
        Assertion::notNull(
            $ivr,
            "IVR is not properly defined. Check configuration."
        );

        // Some feedback for asterisk cli
        $this->agi->notice("Processing IVR %s [ivr%d]", $ivr->getName(), $ivr->getId());

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

        // Check if the pressed input matches one of the configured extensions
        /** @var IvrEntryInterface[] $entries */
        $entries = $ivr->getEntries();
        foreach ($entries as $entry) {

            // Numeric entry, handle as just a number
            if (is_numeric($entry->getEntry())) {
                $entryMatched = $entry->getEntry() == $userPressed;
            // Not numeric entry, handle as regular expression
            } else {
                $entryMatched = preg_match('/' . $entry->getEntry() . '/', $userPressed);
            }

            // Found a matching ivr entry
            if ($entryMatched) {
                $this->agi->notice("Entered value %d matches entry %s.", $userPressed, $entry->getEntry());

                // Entered data matched one of the entries, play success (if any)
                $this->agi->playback($ivr->getSuccessLocution());

                // Play entry success (if any)
                $this->agi->playback($entry->getWelcomeLocution());

                // Route to destination
                $this->_routeType               = $entry->getRouteType();
                $this->_routeExtension          = $entry->getExtension();
                $this->_routeVoiceMail          = $entry->getVoiceMailUser();
                $this->_routeExternal           = $entry->getNumberValueE164();
                $this->_routeConditionalRoute   = $entry->getConditionalRoute();

                // Routed! :)
                return $this->route();
            }
        }

        // No Ivr entry matched, check if dialing extensions is supported
        if ($ivr->getAllowExtensions()) {

            // Check if the dialed number belongs to a company Extension
            $company = $ivr->getCompany();
            $extension = $company->getExtension($userPressed);
            if ($extension) {

                // Check extension is not excluded
                /** @var IvrExcludedExtensionInterface[] $excludedExtensions */
                $excludedExtensions = $ivr->getExcludedExtensions();
                foreach ($excludedExtensions as $excludedExtension) {
                    if ($extension == $excludedExtension->getExtension()) {
                        $this->agi->error("Dialed number %d is in the excluded extensions list.", $userPressed);
                        return $this->processError();
                    }
                }

                $this->agi->notice(
                    "Entered value %d matches company extension with id %d",
                    $userPressed,
                    $extension->getId()
                );

                // Entered data matched one of company extensions, play success (if any)
                $this->agi->playback($ivr->getSuccessLocution());

                // Route to dialed extension
                $this->_routeType = 'extension';
                $this->_routeExtension = $extension;

                // Routed! :)
                return $this->route();
            }
        }

        // If we have reached here, none of the entries have matched
        $this->processError();
    }


    public function processTimeout()
    {
        $ivr = $this->_ivr;
        $this->agi->verbose("Processing IVR no input handler.");

        // Play No Input Locution
        $this->agi->playback($ivr->getNoInputLocution());

        // Route to destination
        $this->_routeType       = $ivr->getNoInputRouteType();
        $this->_routeExtension  = $ivr->getNoInputExtension();
        $this->_routeVoiceMail  = $ivr->getNoInputVoiceMailUser();
        $this->_routeExternal   = $ivr->getNoInputNumberValueE164();
        $this->route();
    }

    public function processError()
    {
        $ivr = $this->_ivr;
        $this->agi->verbose("Processing IVR error handler.");

        // Play Error Locution
        $this->agi->playback($ivr->getErrorLocution());

        // Route to destination
        $this->_routeType       = $ivr->getErrorRouteType();
        $this->_routeExtension  = $ivr->getErrorExtension();
        $this->_routeVoiceMail  = $ivr->getErrorVoiceMailUser();
        $this->_routeExternal   = $ivr->getErrorNumberValueE164();
        $this->route();
    }

}
