<?php

namespace Ivoz\Provider\Domain\Assembler\CalendarPeriod;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodDto;
use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface;
use Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule\CalendarPeriodsRelSchedule;

class CalendarPeriodDtoAssembler implements CustomDtoAssemblerInterface
{
    /**
     * @param CalendarPeriodInterface $entity
     * @throws \Exception
     */
    public function toDto(EntityInterface $entity, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($entity, CalendarPeriodInterface::class);

        $dto = $entity->toDto($depth);

        if ($context !== CalendarPeriodDto::CONTEXT_EMPTY) {
            $scheduleIds = array_map(
                function (CalendarPeriodsRelSchedule $calendarPeriodsRelSchedule) {
                    return (int) $calendarPeriodsRelSchedule
                        ->getSchedule()
                        ->getId();
                },
                $entity->getRelSchedules()
            );

            $dto->setScheduleIds(
                $scheduleIds
            );
        }

        return $dto;
    }
}
