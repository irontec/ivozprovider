<?php

namespace Ivoz\Provider\Domain\Service\InvoiceScheduler;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;

/**
 * Class NextExecutionResolver
 */
class NextExecutionResolver implements InvoiceSchedulerLifecycleEventHandlerInterface
{
    const PRE_PERSIST_PRIORITY = LifecycleEventHandlerInterface::PRIORITY_NORMAL;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function __construct(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY,
        ];
    }

    public function execute(InvoiceSchedulerInterface $scheduler, bool $isNew)
    {
        $nextExecution = $scheduler->getNextExecution();
        if (!$nextExecution) {
            $this->setFallbackNextExecution($scheduler);
            return;
        }

        $this->updateNextExecution($scheduler);
    }

    /**
     * @see http://php.net/manual/es/datetime.formats.relative.php
     * @param InvoiceSchedulerInterface $scheduler
     */
    protected function setFallbackNextExecution(InvoiceSchedulerInterface $scheduler)
    {
        $frecuency = $scheduler->getFrequency() -1;
        $unit = $scheduler->getUnit();

        $timeZone = $scheduler->getBrand()->getDefaultTimezone();
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
    protected function updateNextExecution(InvoiceSchedulerInterface $scheduler)
    {
        if (!$scheduler->hasChanged('lastExecution')) {
            return;
        }

        if ($scheduler->hasChanged('nextExecution')) {
            // Manually updated
            return;
        }

        $nextExecution = clone $scheduler->getNextExecution();
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
    protected function setNextExecution(InvoiceSchedulerInterface $scheduler, \DateTime $nextExecution)
    {
        /** @var InvoiceSchedulerDto $schedulerDto */
        $schedulerDto = $this->entityTools->entityToDto($scheduler);
        $schedulerDto->setNextExecution(
            $nextExecution
        );

        $this->entityTools->persistDto(
            $schedulerDto,
            $scheduler,
            false
        );
    }
}