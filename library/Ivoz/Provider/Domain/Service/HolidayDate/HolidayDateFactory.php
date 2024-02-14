<?php

namespace Ivoz\Provider\Domain\Service\HolidayDate;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateDto;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface;

class HolidayDateFactory
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    /**
     * @throws \Exception
     */
    public function fromMassProvisioningCsv(
        string $calendarId,
        string $eventName,
        string $eventDate,
    ): HolidayDateInterface {

        $holidayDateDto =  new HolidayDateDto();

        $eventDate = new \DateTime($eventDate);
        $holidayDateDto
            ->setName($eventName)
            ->setEventDate($eventDate)
            ->setCalendarId((int) $calendarId);

        /** @var HolidayDateInterface $holidayDate */
        $holidayDate = $this
            ->entityTools
            ->dtoToEntity(
                $holidayDateDto
            );

        return $holidayDate;
    }
}
