<?php
namespace Ivoz\Provider\Domain\Service\OutgoingRoutingRelCarrier;

use Ivoz\Core\Domain\Service\AvoidEntityUpdatesAbstract;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface;

class AvoidUpdates extends AvoidEntityUpdatesAbstract implements OutgoingRoutingRelCarrierLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => AvoidEntityUpdatesAbstract::PRE_PERSIST_PRIORITY,
        ];
    }
    /**
     * @param OutgoingRoutingRelCarrierInterface $entity
     *
     * @throws \DomainException
     *
     * @return void
     */
    public function execute(OutgoingRoutingRelCarrierInterface $entity)
    {
        $this->assertUnchanged($entity);
    }
}
