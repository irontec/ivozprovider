<?php

namespace Ivoz\Provider\Application\Service\ExternalCallFilter;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackList;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendar;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelSchedule;
use Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteList;

class ExternalCallFilterDtoAssembler implements CustomDtoAssemblerInterface
{
    /**
     * @param ExternalCallFilterInterface $entity
     * @throws \Exception
     */
    public function toDto(EntityInterface $entity, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($entity, ExternalCallFilterInterface::class);

        $dto = $entity->toDto($depth);

        if (in_array($context, ExternalCallFilterDto::CONTEXTS_WITH_INVERSE_RELATIONSHIPS, true)) {
            $whitelistIds = array_map(
                function (ExternalCallFilterWhiteList $relMatchlist) {
                    return $relMatchlist
                        ->getMatchlist()
                        ->getId();
                },
                $entity->getWhiteLists()
            );

            $scheduleIds = array_map(
                function (ExternalCallFilterRelSchedule $relSchedule) {
                    return $relSchedule
                        ->getSchedule()
                        ->getId();
                },
                $entity->getSchedules()
            );

            $calendarIds = array_map(
                function (ExternalCallFilterRelCalendar $relCalendar) {
                    return $relCalendar
                        ->getCalendar()
                        ->getId();
                },
                $entity->getCalendars()
            );

            $blacklistIds = array_map(
                function (ExternalCallFilterBlackList $relMatchlist) {
                    return $relMatchlist
                        ->getMatchlist()
                        ->getId();
                },
                $entity->getBlackLists()
            );

            $dto
                ->setWhiteListIds(
                    $whitelistIds
                )
                ->setScheduleIds(
                    $scheduleIds
                )
                ->setCalendarIds(
                    $calendarIds
                )
                ->setBlackListIds(
                    $blacklistIds
                );
        }

        return $dto;
    }
}
