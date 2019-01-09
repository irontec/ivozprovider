<?php

namespace Ivoz\Provider\Domain\Service\InvoiceScheduler;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Core\Domain\Model\SchedulerInterface;

trait NextExecutionResolverTrait
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @see http://php.net/manual/es/datetime.formats.relative.php
     * @param InvoiceSchedulerInterface $scheduler
     * @param TimezoneInterface $timeZone
     */
    protected function setFallbackNextExecution(SchedulerInterface $scheduler, TimezoneInterface $timeZone)
    {
        $frecuency = $scheduler->getFrequency() -1;
        $unit = $scheduler->getUnit();

        $dateTimeZone = new \DateTimeZone($timeZone->getTz());

        $nextExecution = new \DateTime(
            null,
            $dateTimeZone
        );
        $nextExecution->modify("+${frecuency} ${unit}s");

        switch ($unit) {
            case 'year':
                $nextExecution->modify('first day of january, next year');
                break;
            case 'week':
                $nextExecution->modify('next monday');
                break;
            case 'month':
                $nextExecution->modify('first day of next month');
                break;
            case 'day':
                $nextExecution->modify('next day');
                break;
            default:
                throw new \DomainException('Unknown unit ' . $unit);
        }

        $nextExecution->setTime(8, 0, 0);

        $this->setNextExecution(
            $scheduler,
            $nextExecution
        );
    }

    /**
     * @param InvoiceSchedulerInterface $scheduler
     */
    protected function updateNextExecution(SchedulerInterface $scheduler)
    {
        if (!$scheduler->hasChanged('lastExecution')) {
            return;
        }

        if ($scheduler->hasChanged('nextExecution')) {
            // Manually updated
            return;
        }

        $nextExecution = $scheduler->getNextExecution();
        if (!$nextExecution) {
            return;
        }
        $nextExecution->setTimezone(
            new \DateTimeZone('UTC')
        );

        $nextExecution
            ->add(
                $scheduler->getInterval()
            );

        $this->setNextExecution(
            $scheduler,
            $nextExecution
        );
    }

    /**
     * @param InvoiceSchedulerInterface $scheduler
     * @param \DateTime $nextExecution
     */
    protected function setNextExecution(SchedulerInterface $scheduler, \DateTime $nextExecution)
    {
        $schedulerDto = $this->entityTools->entityToDto($scheduler);
        $schedulerDto->setNextExecution(
            $nextExecution
        );

        $this->entityTools->updateEntityByDto(
            $scheduler,
            $schedulerDto
        );
    }
}
