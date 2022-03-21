<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface;
use Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface;

class IvrAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var RouterAction
     */
    protected $routerAction;

    /**
     * @var IvrInterface|null
     */
    protected $ivr;

    /**
     * IvrAction constructor.
     *
     * @param Wrapper $agi
     * @param RouterAction $routerAction
     */
    public function __construct(
        Wrapper $agi,
        RouterAction $routerAction
    ) {
        $this->agi = $agi;
        $this->routerAction = $routerAction;
    }

    /**
     * @param IvrInterface|null $ivr
     * @return $this
     */
    public function setIVR(IvrInterface $ivr = null)
    {
        $this->ivr = $ivr;
        return $this;
    }


    public function process()
    {
        $ivr = $this->ivr;

        if (is_null($ivr)) {
            $this->agi->error("IVR is not properly defined. Check configuration.");
            return;
        }

        // Some feedback for asterisk cli
        $this->agi->notice("Processing IVR %s", $ivr);

        // Get IVR all Locutions
        $welcomeLocution = null;
        if (!empty($ivr->getWelcomeLocution())) {
            $welcomeLocution = $ivr->getWelcomeLocution();
        }

        // Play locution and expect user press
        $userPressed = $this->agi->readLocution($welcomeLocution, $ivr->getTimeout(), $ivr->getMaxDigits());
        $this->agi->verbose("IVR: User entered: %s", $userPressed);

        // User prefer Human interaction
        if ($userPressed == "HANGUP") {
            return;
        }

        // User hasn't pressed anything
        if ($userPressed === "") {
            $this->processNoInput();
            return;
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
                $this->agi->playbackLocution($ivr->getSuccessLocution());

                // Play success locution (if any)
                $successLocution = is_null($entry->getWelcomeLocution())
                    ? $ivr->getSuccessLocution()
                    : $entry->getWelcomeLocution();

                $this->agi->playbackLocution($successLocution);

                // Route to destination
                $this->routerAction
                    ->setRouteType($entry->getRouteType())
                    ->setRouteExtension($entry->getExtension())
                    ->setRouteVoicemail($entry->getVoicemail())
                    ->setRouteExternal($entry->getNumberValueE164())
                    ->setRouteConditional($entry->getConditionalRoute())
                    ->route();

                // Call successfully routed
                return;
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
                    if ($extension->getId() == $excludedExtension->getExtension()->getId()) {
                        $this->agi->error("Dialed number %d is in the excluded extensions list.", $userPressed);
                        $this->processError();
                        return;
                    }
                }

                $this->agi->notice("Entered value %d matches company extension %s", $userPressed, $extension);

                // Entered data matched one of company extensions, play success (if any)
                $this->agi->playbackLocution($ivr->getSuccessLocution());

                // Route to dialed extension
                $this->routerAction
                    ->setRouteType(RouterAction::Extension)
                    ->setRouteExtension($extension)
                    ->route();

                // Call successfully routed
                return;
            }
        }

        // If we have reached here, none of the entries have matched
        $this->processError();
    }

    /**
     * Process Ivr No Input handler
     */
    public function processNoInput()
    {
        $this->agi->verbose("Processing IVR no input handler.");

        // Play No Input Locution
        $this->agi->playbackLocution($this->ivr->getNoInputLocution());

        // Route to destination
        $this->routerAction
            ->setRouteType($this->ivr->getNoInputRouteType())
            ->setRouteExtension($this->ivr->getNoInputExtension())
            ->setRouteVoicemail($this->ivr->getNoInputVoicemail())
            ->setRouteExternal($this->ivr->getNoInputNumberValueE164())
            ->route();
    }

    /**
     * Process Ivr Error handler
     */
    public function processError()
    {
        $this->agi->verbose("Processing IVR error handler.");

        // Play Error Locution
        $this->agi->playbackLocution($this->ivr->getErrorLocution());

        // Route to destination
        $this->routerAction
            ->setRouteType($this->ivr->getErrorRouteType())
            ->setRouteExtension($this->ivr->getErrorExtension())
            ->setRouteVoicemail($this->ivr->getErrorVoicemail())
            ->setRouteExternal($this->ivr->getErrorNumberValueE164())
            ->route();
    }
}
