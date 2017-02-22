<?php

namespace Agi\Action;
use Agi\Action\ExternalFilterAction;

class DDIAction extends RouterAction
{
    protected $_ddi;

    public function setDDI($ddi)
    {
        $this->_ddi = $ddi;
        return $this;
    }

    public function process()
    {
        // Local variables to improve readability
        $ddi = $this->_ddi;

        // Validate Action
        if (empty($this->_ddi)) {
            $this->agi->error("DDI is not properly defined. Check configuration.");
            return;
        }

        // Some feedback for asterisk cli
        $this->agi->notice("Processing DDI with number %s [ddi%d]", $ddi->getDDI(), $ddi->getId());

        // Check And Process if necesary external call filters
        $externalCallFilter = $ddi->getExternalCallFilter();
        if (! empty($externalCallFilter)) {
            // Some feedback for asterisk cli
            $this->agi->notice("DDI %s [ddi%d] has filter %s [externalcallfilter%d]",
                            $ddi->getDDI(), $ddi->getId(),
                            $externalCallFilter->getName(), $externalCallFilter->getId());

            // Transform origin to company preferred
            $origin = $ddi->getCompany()->E164ToPreferred($this->agi->getCallerIdNum());

            // Users matching BlackList will be always rejected
            if ($externalCallFilter->matchBlackList($origin)) {
                $this->agi->notice("%s matches filter's BlackList. Dropping call.", $origin);
                $this->agi->Hangup(21); // AST_CAUSE_CALL_REJECTED
                return;
            }

            // Users matching WhiteList will skip Holiday/Schedule checks
            if ($externalCallFilter->matchWhiteList($origin)) {
                $this->agi->notice("%s matches filter's whitelist. Calendar/Schedules checks will be skipped.", $origin);
            } else {
                $holidayDate = $externalCallFilter->getHolidayDateForToday();
                if (! empty($holidayDate)) {
                    $this->agi->verbose("DDI %s [ddi%d] is on Holidays.", $ddi->getDDI(), $ddi->getId());
                    $filterAction = new ExternalFilterAction($this);
                    $filterAction
                        ->setDDI($ddi)
                        ->setFilter($externalCallFilter)
                        ->processHoliday();
                    return;
                }

                if (! $externalCallFilter->isOutOfSchedule()) {
                    $this->agi->verbose("DDI %s [ddi%d] is on Out of schedule.", $ddi->getDDI(), $ddi->getId());
                    $filterAction = new ExternalFilterAction($this);
                    $filterAction
                        ->setDDI($ddi)
                        ->setFilter($externalCallFilter)
                        ->processOutOfSchedule();
                    return;
                }
            }

            // Play Welcome message
            $this->agi->playback($externalCallFilter->getWelcomeLocution());
        }

        // Check if this DDI has custom Display Name
        if (!empty($ddi->getDisplayName())) {
            $this->agi->setCallerIdName($ddi->getDisplayName());
        } else {
            $this->agi->setCallerIdName("");
        }

        // Route to the extension destination
        $this->_routeType       = $ddi->getRouteType();
        $this->_routeUser       = $ddi->getUser();
        $this->_routeFax        = $ddi->getFax();
        $this->_routeIVRCommon  = $ddi->getIVRCommon();
        $this->_routeIVRCustom  = $ddi->getIVRCustom();
        $this->_routeHuntGroup  = $ddi->getHuntGroup();
        $this->_routeConference = $ddi->getConferenceRoom();
        $this->_routeFriend     = $ddi->getFriendValue();
        $this->route();
    }
}
