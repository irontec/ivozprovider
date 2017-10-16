<?php

namespace Agi\Action;
use Agi\Action\ExternalFilterAction;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Assert\Assertion;

class DDIAction extends RouterAction
{
    /**
     * @var DdiInterface
     */
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
        Assertion::notNull(
            $ddi,
            "DDI is not properly defined. Check configuration."
        );

        // Some feedback for asterisk cli
        $this->agi->notice("Processing DDI with number %s [ddi%d]", $ddi->getDDI(), $ddi->getId());

        // Check And Process if necesary external call filters
        $externalCallFilter = $ddi->getExternalCallFilter();
        if (! empty($externalCallFilter)) {
            // Some feedback for asterisk cli
            $this->agi->notice("DDI %s [ddi%d] has filter %s [externalcallfilter%d]",
                            $ddi->getDDI(), $ddi->getId(),
                            $externalCallFilter->getName(), $externalCallFilter->getId());

            // Get Call Origin in E.164 format
            $origin = $this->agi->getCallerIdNum();

            // Users matching BlackList will be always rejected
            if ($externalCallFilter->isBlackListed($origin)) {
                $this->agi->error("%s matches filter's BlackList. Dropping call.", $origin);
                $this->agi->Hangup(21); // AST_CAUSE_CALL_REJECTED
                return;
            }

            // Users matching WhiteList will skip Holiday/Schedule checks
            if ($externalCallFilter->isWhitelisted($origin)) {
                $this->agi->notice("%s matches filter's whitelist. Calendar/Schedules checks will be skipped.", $origin);
            } else {
                $holidayDate = $externalCallFilter->getHolidayDateForToday();
                if (! empty($holidayDate)) {
                    $this->agi->verbose("DDI %s [ddi%d] is on Holidays.", $ddi->getDDI(), $ddi->getId());
                    $filterAction = new ExternalFilterAction($this);
                    $filterAction
                        ->setDDI($ddi)
                        ->setFilter($externalCallFilter)
                        ->setLocution($holidayDate->getLocution())
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
        $this->_routeQueue      = $ddi->getQueue();
        $this->_routeRetail     = $ddi->getRetailAccount();
        $this->_routeConditionalRoute = $ddi->getConditionalRoute();
        $this->route();
    }
}
