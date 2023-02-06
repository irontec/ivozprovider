<?php

namespace Ivoz\Provider\Domain\Service\ConditionalRoutesConditionsRelMatchlist;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements ConditionalRoutesConditionsRelMatchlistLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }
    /**
     * @param ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist
     *
     * @return void
     *@throws \DomainException
     *
     */
    public function execute(ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist)
    {
        $this->assertUnchanged($relMatchlist);
    }
}
