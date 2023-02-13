<?php

namespace Ivoz\Provider\Application\Service\ConditionalRoutesCondition;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionDto;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendar;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlist;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLock;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelSchedule;

class ConditionalRoutesConditionDtoAssembler implements CustomDtoAssemblerInterface
{
    /**
     * @param ConditionalRoutesConditionInterface $entity
     * @throws \Exception
     */
    public function toDto(EntityInterface $entity, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($entity, ConditionalRoutesConditionInterface::class);

        $dto = $entity->toDto($depth);

        if (in_array($context, ConditionalRoutesConditionDto::CONTEXTS_WITH_INVERSE_RELATIONSHIPS, true)) {
            $matchlistIds = array_map(
                function (ConditionalRoutesConditionsRelMatchlist $relMatchlist) {
                    return $relMatchlist
                        ->getMatchlist()
                        ->getId();
                },
                $entity->getRelMatchlists()
            );

            $scheduleIds = array_map(
                function (ConditionalRoutesConditionsRelSchedule $relSchedule) {
                    return $relSchedule
                        ->getSchedule()
                        ->getId();
                },
                $entity->getRelSchedules()
            );

            $calendarIds = array_map(
                function (ConditionalRoutesConditionsRelCalendar $relCalendar) {
                    return $relCalendar
                        ->getCalendar()
                        ->getId();
                },
                $entity->getRelCalendars()
            );

            $routeLocksIds = array_map(
                function (ConditionalRoutesConditionsRelRouteLock $relRouteLock) {
                    return $relRouteLock
                        ->getRouteLock()
                        ->getId();
                },
                $entity->getRelRouteLocks()
            );

            $dto
                ->setMatchListIds(
                    $matchlistIds
                )
                ->setScheduleIds(
                    $scheduleIds
                )
                ->setCalendarIds(
                    $calendarIds
                )
                ->setRouteLockIds(
                    $routeLocksIds
                );
        }

        return $dto;
    }
}
