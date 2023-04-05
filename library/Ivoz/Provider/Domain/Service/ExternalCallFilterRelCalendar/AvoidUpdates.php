<?php

namespace Ivoz\Provider\Domain\Service\ExternalCallFilterRelCalendar;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements ExternalCallFilterRelCalendarLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }
    /**
     * @param ExternalCallFilterRelCalendarInterface $relCalendar
     *
     * @return void
     *@throws \DomainException
     *
     */
    public function execute(ExternalCallFilterRelCalendarInterface $relCalendar)
    {
        $this->assertUnchanged($relCalendar);
    }
}
