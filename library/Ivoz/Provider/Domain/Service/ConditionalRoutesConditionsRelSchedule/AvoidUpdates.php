<?php

namespace Ivoz\Provider\Domain\Service\ConditionalRoutesConditionsRelSchedule;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements ConditionalRoutesConditionsRelScheduleLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }
    /**
     * @param ConditionalRoutesConditionsRelScheduleInterface $relSchedule
     *
     * @return void
     *@throws \DomainException
     *
     */
    public function execute(ConditionalRoutesConditionsRelScheduleInterface $relSchedule)
    {
        $this->assertUnchanged($relSchedule);
    }
}
