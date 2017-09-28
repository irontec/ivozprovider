<?php

namespace Agi\Action;

use Assert\Assertion;

class IVRCommonAction extends IVRAction
{

    public function process()
    {
        // Get IVR welcome locution path
        $ivr = $this->_ivr;
        Assertion::notNull(
            $ivr,
            "IVRCommon is not properly defined. Check configuration."
        );

        // Some feedback for asterisk cli
        $this->agi->notice("Processing IVRCommon %s [ivrcommon%d]", $ivr->getName(), $ivr->getId());

        // Play welcome locution if any
        $welcomeLocution = "";
        if (!empty($ivr->getWelcomeLocution())) {
            $welcomeLocution = $ivr->getWelcomeLocution()->getLocutionPath();
        }

        // Play locution and expect user press
        $userPressed = $this->agi->read($welcomeLocution, $ivr->getTimeout(), $ivr->getMaxDigits());
        $this->agi->verbose("IVR: User entered: %s", $userPressed);

        // User prefer Human interaction
        if ($userPressed == "HANGUP")
            return;

        // User hasn't pressed anything
        if (empty($userPressed))
            return $this->processError();

        // Not allowed numbers for this IVR
        $blackList = $ivr->getBlackListRegExp();
        if (! empty($blackList)) {
            if (preg_match("/$blackList/", $userPressed)) {
                $this->agi->verbose("%s is in IVR blacklist.", $userPressed);
                return $this->processError();
            }
        }

        // User pressed a valid Extension number?
        $extension = $ivr->getCompany()->getExtension($userPressed);
        if (empty($extension)) {
            $this->agi->verbose("%s is not a valid extension.", $userPressed);
            return $this->processError();
        }

        // Store current IVR data
        $this->agi->setVariable("IVRID", $ivr->getId());
        $this->agi->setVariable("IVRTYPE", 'COMMON');

        // Success!! Place call to given extension
        $this->agi->playback($ivr->getSuccessLocution());

        // !! Route this IVR using the extension paramaters !!
        $this->_routeType       = 'extension';
        $this->_routeExtension  = $extension;
        $this->route();
    }
}
