<?php

namespace Agi\Action;

class IVRCommonAction extends IVRAction
{

    public function process()
    {
        if (empty($this->_ivr)) {
            $this->agi->error("IVRCommon is not properly defined. Check configuration.");
            return;
        }

        // Get IVR welcome locution path
        $ivr = $this->_ivr;

        // Some feedback for asterisk cli
        $this->agi->notice("Processing IVRCommon %s [ivrcommon%d]", $ivr->getName(), $ivr->getId());

        $welcomLocution = $ivr->getWelcomeLocution()->getLocutionPath();

        // Play locution and expect user press
        $userPressed = $this->agi->read($welcomLocution, $ivr->getTimeout());
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

        // Success!! Place call to given extension
        $this->agi->playback($ivr->getSuccessLocution());

        // !! Route this IVR using th extension parmaters !!
        $this->_routeType       = $extension->getRouteType();
        $this->_routeUser       = $extension->getUser();
        $this->_routeIVRCommon  = $extension->getIVRCommon();
        $this->_routeIVRCustom  = $extension->getIVRCustom();
        $this->_routeHuntGroup  = $extension->getHuntGroup();
        $this->route();
    }
}
