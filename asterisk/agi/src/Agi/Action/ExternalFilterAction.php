<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface;

class ExternalFilterAction
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
     * @var \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface
     */
    protected $filter;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    protected $ddi;

    /**
     * @var HolidayDateInterface
     */
    protected $holidayDate;


    /**
     * ExternalFilterAction constructor.
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
     * @param HolidayDateInterface|null $holidayDate
     * @return $this
     */
    public function setHolidayDate(HolidayDateInterface $holidayDate = null)
    {
        $this->holidayDate = $holidayDate;
        return $this;
    }

    /**
     * @param ExternalCallFilterInterface|null $filter
     * @return $this
     */
    public function setFilter(ExternalCallFilterInterface $filter = null)
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * @param DdiInterface $ddi
     * @return $this
     */
    public function setDDI(DdiInterface $ddi)
    {
        $this->ddi = $ddi;
        return $this;
    }

    public function processHoliday()
    {

        $filter = $this->filter;
        $ddi = $this->ddi;

        if (empty($filter) || empty($ddi)) {
            $this->agi->error("ExternalFilter is not properly defined. Check configuration.");
            return;
        }

        // Some feedback for the asterisk cli
        $this->agi->notice("Processing Holiday filter %s for DDI %s", $filter, $ddi);

        $locution = $filter->getHolidayLocution();
        // Play holiday locution
        if (!is_null($this->holidayDate)) {
            $eventLocution = $this->holidayDate->getLocution();
            if (!is_null($eventLocution)) {
                $locution = $eventLocution;
            }
        }

        // Play holiday louction
        $this->agi->playbackLocution($locution);

        // Set Diversion information
        $count = $this->agi->getRedirecting('count');
        $this->agi->setRedirecting('count,i', ++$count);
        $this->agi->setRedirecting('from-name,i', $ddi->getCompany()->getName());
        $this->agi->setRedirecting('from-num,i', $ddi->getDDIE164());
        $this->agi->setRedirecting('reason', 'time_of_day');

        if (!is_null($this->holidayDate->getRouteType())) {
            // Route to using event
            $this->routerAction
                ->setRouteType($this->holidayDate->getRouteType())
                ->setRouteExtension($this->holidayDate->getExtension())
                ->setRouteExternal($this->holidayDate->getNumberValueE164())
                ->setRouteVoicemail($this->holidayDate->getVoiceMailUser())
                ->route();
        } else {
            // Route to using filter
            $this->routerAction
                ->setRouteType($filter->getHolidayTargetType())
                ->setRouteExtension($filter->getHolidayExtension())
                ->setRouteExternal($filter->getHolidayNumberValueE164())
                ->setRouteVoicemail($filter->getHolidayVoiceMailUser())
                ->route();
        }
    }

    public function processOutOfSchedule()
    {
        $filter = $this->filter;
        $ddi = $this->ddi;

        if (empty($filter) || empty($ddi)) {
            $this->agi->error("ExternalFilter is not properly defined. Check configuration.");
            return;
        }

        // Some feedback for the asterisk cli
        $this->agi->notice("Processing OutOfSchedule filter %s for DDI %s", $filter, $ddi);

        // Play holiday locution
        $this->agi->playbackLocution($this->filter->getOutOfScheduleLocution());

        // Set Diversion information
        $count = $this->agi->getRedirecting('count');
        $this->agi->setRedirecting('count,i', ++$count);
        $this->agi->setRedirecting('from-name,i', $ddi->getCompany()->getName());
        $this->agi->setRedirecting('from-num,i', $ddi->getDDIE164());
        $this->agi->setRedirecting('reason', 'time_of_day');

        // Route to destination
        $this->routerAction
            ->setRouteType($filter->getOutOfScheduleTargetType())
            ->setRouteExtension($filter->getOutOfScheduleExtension())
            ->setRouteExternal($filter->getOutOfScheduleNumberValueE164())
            ->setRouteVoicemail($filter->getOutOfScheduleVoiceMailUser())
            ->route();
    }
}
