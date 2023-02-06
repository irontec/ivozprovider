<?php

namespace Ivoz\Provider\Domain\Service\ExternalCallFilterRelSchedule;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements ExternalCallFilterRelScheduleLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }
    /**
     * @param ExternalCallFilterRelScheduleInterface $relSchedule
     *
     * @return void
     *@throws \DomainException
     *
     */
    public function execute(ExternalCallFilterRelScheduleInterface $relSchedule)
    {
        $this->assertUnchanged($relSchedule);
    }
}
