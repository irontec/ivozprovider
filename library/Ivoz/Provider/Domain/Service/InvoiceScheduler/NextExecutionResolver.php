<?php

namespace Ivoz\Provider\Domain\Service\InvoiceScheduler;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;

/**
 * Class NextExecutionResolver
 */
class NextExecutionResolver implements InvoiceSchedulerLifecycleEventHandlerInterface
{
    const PRE_PERSIST_PRIORITY = LifecycleEventHandlerInterface::PRIORITY_NORMAL;

    public function __construct() {}

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
            case 'week':
                $nextExecution->modify('next monday');
                break;
            case 'month':
                $nextExecution->modify('next month');
                break;
            default:
                throw new \DomainException('Unkown unit ' . $unit);
        }


        $nextExecution->setTime(8, 0, 0);
        $scheduler->setNextExecution(
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

        $lastExecution = $scheduler->getLastExecution();
        if (!$lastExecution) {
            return;
        }
        $lastExecution->setTimezone(
            new \DateTimeZone('UTC')
        );

        $nextExecution = clone $lastExecution;
        $nextExecution
            ->add(
                $scheduler->getInterval()
            );

        $scheduler
            ->setNextExecution($nextExecution);
    }
}