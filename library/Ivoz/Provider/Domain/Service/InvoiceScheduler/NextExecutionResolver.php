<?php

namespace Ivoz\Provider\Domain\Service\InvoiceScheduler;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;

/**
 * Class NextExecutionResolver
 */
class NextExecutionResolver implements InvoiceSchedulerLifecycleEventHandlerInterface
{
    use NextExecutionResolverTrait;

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
