<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface;
use Ivoz\Provider\Domain\Service\CarrierServer\CarrierServerLifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Service\TrunksLcrGateway\UpdateByCarrierServer;

/**
 * Class CreateByCarrierServer
 * @package Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget
 */
class CreateByCarrierServer implements CarrierServerLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = UpdateByCarrierServer::POST_PERSIST_PRIORITY + 10;

    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var CreateByOutgoingRouting
     */
    protected $lcrRuleTargetFactory;

    /**
     * CreateByCarrierServer constructor.
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
     * @param CarrierServerInterface $entity
     * @param $isNew
     */
    public function execute(CarrierServerInterface $entity, $isNew)
    {
        if (!$isNew) {
            return;
        }

        /** @var OutgoingRoutingInterface[] $outgoingRoutings */
        $outgoingRoutings = $entity->getCarrier()->getOutgoingRoutings();

        foreach ($outgoingRoutings as $outgoingRouting) {
            $this->lcrRuleTargetFactory->execute($outgoingRouting);
        }
    }
}