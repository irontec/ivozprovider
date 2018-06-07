<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;
use Ivoz\Provider\Domain\Service\PeerServer\PeerServerLifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Service\TrunksLcrGateway\UpdateByPeerServer;

/**
 * Class CreateByPeerServer
 * @package Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget
 */
class CreateByPeerServer implements PeerServerLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = UpdateByPeerServer::POST_PERSIST_PRIORITY + 10;

    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var CreateByOutgoingRouting
     */
    protected $lcrRuleTargetFactory;

    /**
     * CreateByPeerServer constructor.
     * @param EntityPersisterInterface $entityPersister
     * @param CreateByOutgoingRouting $lcrRuleTargetFactory
     */
    public function __construct(
        EntityPersisterInterface $entityPersister,
        CreateByOutgoingRouting $lcrRuleTargetFactory
    ) {
        $this->entityPersister = $entityPersister;
        $this->lcrRuleTargetFactory = $lcrRuleTargetFactory;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @param PeerServerInterface $entity
     * @param $isNew
     */
    public function execute(PeerServerInterface $entity, $isNew)
    {
        if (!$isNew) {
            return;
        }

        /** @var OutgoingRoutingInterface[] $outgoingRoutings */
        $outgoingRoutings = $entity->getPeeringContract()->getOutgoingRoutings();

        foreach ($outgoingRoutings as $outgoingRouting) {
            $this->lcrRuleTargetFactory->execute($outgoingRouting);
        }
    }
}