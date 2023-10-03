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
                ->setName($holidayDateRange->getName())
                ->setEventDate($startDate)
                ->setWholeDayEvent((bool) $holidayDateRange->getWholeDayEvent())
                ->setLocutionId($holidayDateRange->getLocution())
                ->setRouteType($holidayDateRange->getRouteType())
                ->setExtensionId($holidayDateRange->getExtension())
                ->setVoicemailId($holidayDateRange->getVoicemail())
                ->setNumberCountryId($holidayDateRange->getNumberCountry())
                ->setNumberValue($holidayDateRange->getNumberValue());

            if (!$holidayDateRange->getWholeDayEvent()) {
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
