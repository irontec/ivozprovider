<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface;
use Ivoz\Provider\Domain\Service\CarrierServer\CarrierServerLifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Service\TrunksLcrGateway\UpdateByCarrierServer as LcrGatewayUpdateByCarrierServer;

/**
 * Class UpdateByCarrierServer
 * @package Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget
 */
class UpdateByCarrierServer implements CarrierServerLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = LcrGatewayUpdateByCarrierServer::POST_PERSIST_PRIORITY + 10;

    /**
     * @var TrunksLcrRuleTargetFactory
     */
    protected $lcrRuleTargetFactory;

    /**
     * CreateByCarrierServer constructor.
     * @param EntityPersisterInterface $entityPersister
     * @param TrunksLcrRuleTargetFactory $lcrRuleTargetFactory
     */
    public function __construct(
        TrunksLcrRuleTargetFactory $lcrRuleTargetFactory
    ) {
        $this->lcrRuleTargetFactory = $lcrRuleTargetFactory;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @param CarrierServerInterface $carrierServer
     */
    public function execute(CarrierServerInterface $carrierServer)
    {
        $isNew = $carrierServer->isNew();
        if (!$isNew) {
            return;
        }

        /** @var OutgoingRoutingInterface[] $outgoingRoutings */
        $outgoingRoutings = $carrierServer->getCarrier()->getOutgoingRoutings();

        foreach ($outgoingRoutings as $outgoingRouting) {
            $this->lcrRuleTargetFactory->execute($outgoingRouting);
        }
    }
}
