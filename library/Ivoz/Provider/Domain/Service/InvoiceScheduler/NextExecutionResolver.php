<?php

namespace Ivoz\Provider\Domain\Service\InvoiceScheduler;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;

class NextExecutionResolver implements InvoiceSchedulerLifecycleEventHandlerInterface
{
    use NextExecutionResolverTrait;

    public const PRE_PERSIST_PRIORITY = LifecycleEventHandlerInterface::PRIORITY_NORMAL;

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

    /**
     * @return void
     */
    public function execute(InvoiceSchedulerInterface $scheduler)
    {
        $nextExecution = $scheduler->getNextExecution();
        if (!$nextExecution) {
            $timeZone = $scheduler->getBrand()->getDefaultTimezone();
            $this->setFallbackNextExecution(
                $scheduler,
                $timeZone
            );

            return;
        }

        $this->updateNextExecution($scheduler);
    }
}
