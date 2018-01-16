<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;

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
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    protected $eventLocution;


    /**
     * ExternalFilterAction constructor.
     * 
     * @param Wrapper $agi
     * @param RouterAction $routerAction
     */
    public function __construct(
        Wrapper $agi,
        RouterAction $routerAction
    )
    {
        $this->agi = $agi;
        $this->routerAction = $routerAction;
    }

    /**
     * @param LocutionInterface|null $locution
     * @return $this
     */
    public function setLocution(LocutionInterface $locution = null)
    {
        $this->eventLocution = $locution;
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
        $this->agi->notice("Procesing Holiday filter %s for DDI %s", $filter, $ddi);

        // Play holiday locution
        if (!empty($this->eventLocution)) {
            $this->agi->playback($this->eventLocution);
        } else {
            $this->agi->playback($filter->getHolidayLocution());
        }

        // Set Diversion information
        $count = $this->agi->getRedirecting('count');
        $this->agi->setRedirecting('count,i', ++$count);
        $this->agi->setRedirecting('from-name,i', $ddi->getCompany()->getName());
        $this->agi->setRedirecting('from-num,i', $ddi->getDDIE164());
        $this->agi->setRedirecting('reason', 'time_of_day');

        // Route to configured destination
        $this->routerAction
            ->setRouteType($filter->getHolidayTargetType())
            ->setRouteExtension($filter->getHolidayExtension())
            ->setRouteExternal($filter->getHolidayNumberValueE164())
            ->setRouteVoicemail($filter->getHolidayVoiceMailUser())
            ->route();

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
        $this->agi->notice("Procesing OutOfSchedule filter %s for DDI %s", $filter, $ddi);

        // Play holiday locution
        $this->agi->playback($this->filter->getOutOfScheduleLocution());

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
