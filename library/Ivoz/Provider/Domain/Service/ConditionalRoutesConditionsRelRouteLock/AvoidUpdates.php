<?php

namespace Ivoz\Provider\Domain\Service\ConditionalRoutesConditionsRelRouteLock;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements ConditionalRoutesConditionsRelRouteLockLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }
    /**
     * @param ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock
     *
     * @return void
     *@throws \DomainException
     *
     */
    public function execute(ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock)
    {
        $this->assertUnchanged($relRouteLock);
    }
}
