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

            // Play Welcome message
            $this->agi->playback($externalCallFilter->getWelcomeLocution());
        }

        // Route to the extension destination
        $this->_routeType       = $ddi->getRouteType();
        $this->_routeUser       = $ddi->getUser();
        $this->_routeFax        = $ddi->getFax();
        $this->_routeIVRCommon  = $ddi->getIVRCommon();
        $this->_routeIVRCustom  = $ddi->getIVRCustom();
        $this->_routeHuntGroup  = $ddi->getHuntGroup();
        $this->_routeConference = $ddi->getConferenceRoom();
        $this->route();
    }
}
