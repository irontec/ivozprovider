<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDate;

class DdiAction
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
     * @var ExternalFilterAction
     */
    protected $externalFilterAction;

    /**
     * @var DdiInterface
     */
    protected $_ddi;

    /**
     * DDIAction constructor.
     *
     * @param Wrapper $agi
     * @param RouterAction $routerAction
     * @param ExternalFilterAction $externalFilterAction
     */
    public function __construct(
        Wrapper $agi,
        RouterAction $routerAction,
        ExternalFilterAction $externalFilterAction
    ) {
        $this->agi = $agi;
        $this->routerAction = $routerAction;
        $this->externalFilterAction = $externalFilterAction;
    }

    /**
     * @param DdiInterface $ddi
     * @return $this
     */
    public function setDDI(DdiInterface $ddi)
    {
        $this->_ddi = $ddi;
        return $this;
    }

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function process()
    {
        // Local variables to improve readability
        $ddi = $this->_ddi;
        if (is_null($ddi)) {
            $this->agi->error("DDI is not properly defined. Check configuration.");
            return;
        }

        // Some feedback for asterisk cli
        $this->agi->notice("Processing DDI with <white>%s</white>", $ddi);

        // Check And Process if necesary external call filters
        $externalCallFilter = $ddi->getExternalCallFilter();
        if (! empty($externalCallFilter)) {
            // Some feedback for asterisk cli
            $this->agi->notice("DDI <white>%s</white> has filter %s", $ddi, $externalCallFilter);

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
                /** @var HolidayDate $holidayDate */
                $holidayDate = $externalCallFilter->getHolidayDateForToday();
                if (! empty($holidayDate)) {
                    $this->agi->verbose("DDI %s is on Holidays.", $ddi);
                    $this->externalFilterAction
                        ->setDDI($ddi)
                        ->setFilter($externalCallFilter)
                        ->setHolidayDate($holidayDate)
                        ->processHoliday();
                    return;
                }

                if ($externalCallFilter->isOutOfSchedule()) {
                    $this->agi->verbose("DDI %s is on Out of schedule.", $ddi);
                    $this->externalFilterAction
                        ->setDDI($ddi)
                        ->setFilter($externalCallFilter)
                        ->processOutOfSchedule();
                    return;
                }
            }

            // Play Welcome message
            $this->agi->playbackLocution($externalCallFilter->getWelcomeLocution());
        }

        // Check if this DDI has custom Display Name
        if (!empty($ddi->getDisplayName())) {
            $this->agi->setCallerIdName($ddi->getDisplayName());
        } else {
            $this->agi->setCallerIdName("");
        }

        // Route to the extension destination
        $this->routerAction
            ->setRouteType($ddi->getRouteType())
            ->setRouteUser($ddi->getUser())
            ->setRouteFax($ddi->getFax())
            ->setRouteIvr($ddi->getIvr())
            ->setRouteHuntGroup($ddi->getHuntGroup())
            ->setRouteConferenceRoom($ddi->getConferenceRoom())
            ->setRouteFriendDestination($ddi->getFriendValue())
            ->setRouteQueue($ddi->getQueue())
            ->setRouteResidential($ddi->getResidentialDevice())
            ->setRouteConditional($ddi->getConditionalRoute())
            ->route();
    }
}
