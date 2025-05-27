<?php

namespace Ivoz\Provider\Domain\Service\ConditionalRoutesConditionsRelCalendar;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements ConditionalRoutesConditionsRelCalendarLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }
    /**
     * @param ConditionalRoutesConditionsRelCalendarInterface $relCalendar
     *
     * @return void
     *@throws \DomainException
     *
     */
    public function execute(ConditionalRoutesConditionsRelCalendarInterface $relCalendar)
    {
        $this->assertUnchanged($relCalendar);
    }
}
