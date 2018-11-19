<?php

namespace Ivoz\Provider\Domain\Service\CallCsvScheduler;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;
use Ivoz\Provider\Domain\Service\InvoiceScheduler\NextExecutionResolverTrait;

/**
 * Class NextExecutionResolver
 */
class NextExecutionResolver implements CallCsvSchedulerLifecycleEventHandlerInterface
{
    use NextExecutionResolverTrait;

    const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

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

    public function execute(CallCsvSchedulerInterface $scheduler)
    {
        $nextExecution = $scheduler->getNextExecution();
        if (!$nextExecution) {
            $timeZone = $scheduler->getTimezone();
            $this->setFallbackNextExecution($scheduler, $timeZone);

            return;
        }

        /**
         * @todo this should be avoided when entity is new
         */
        $this->updateNextExecution($scheduler);
    }
}
