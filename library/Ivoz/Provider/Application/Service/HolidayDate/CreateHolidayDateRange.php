<?php

namespace Ivoz\Provider\Application\Service\HolidayDate;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateDto;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateRange;

class CreateHolidayDateRange
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    public function execute(
        HolidayDateRange $holidayDateRange
    ): void {
        $startDate = new \DateTime($holidayDateRange->getStartDate()) ;
        $endDate = new \DateTime($holidayDateRange->getEndDate());

        while ($startDate <= $endDate) {
            $holidayDto = new HolidayDateDto();
            $holidayDto
                ->setCalendarId($holidayDateRange->getCalendar())
                ->setWholeDayEvent((bool) $holidayDateRange->getWholeDayEvent())
                ->setLocutionId($holidayDateRange->getLocution())
                ->setName($holidayDateRange->getName())
                ->setRouteType($holidayDateRange->getRouteType())
                ->setEventDate($startDate);

            if ($holidayDateRange->getWholeDayEvent() === 1) {
                $timeIn = new \DateTime((string) $holidayDateRange->getTimeIn());
                $timeOut = new \DateTime((string) $holidayDateRange->getTimeOut());

                $holidayDto
                    ->setTimeIn($timeIn)
                    ->setTimeOut($timeOut);
            }

            $this->entityTools->persistDto(
                $holidayDto,
                null,
                false
            );

            $startDate->add(
                \DateInterval::createFromDateString('1 day')
            );
        }

        $this->entityTools->dispatchQueuedOperations();
    }
}
