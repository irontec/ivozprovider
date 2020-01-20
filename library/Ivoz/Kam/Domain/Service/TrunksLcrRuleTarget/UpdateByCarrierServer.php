<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget;

use Ivoz\Kam\Domain\Service\TrunksLcrGateway\UpdateByCarrierServer as LcrGatewayUpdateByCarrierServer;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Service\CarrierServer\CarrierServerLifecycleEventHandlerInterface;

/**
 * Class UpdateByCarrierServer
 * @package Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget
 */
class UpdateByCarrierServer implements CarrierServerLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = LcrGatewayUpdateByCarrierServer::POST_PERSIST_PRIORITY + 10;
    const POST_REMOVE_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var TrunksLcrRuleTargetFactory
     */
    protected $lcrRuleTargetFactory;

    /**
     * CreateByCarrierServer constructor.
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
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY,
            self::EVENT_POST_REMOVE => self::POST_REMOVE_PRIORITY
        ];
    }

    /**
     * @param CarrierServerInterface $carrierServer
     *
     * @return void
     */
    public function execute(CarrierServerInterface $carrierServer)
    {
        $isNew = $carrierServer->isNew();
        $isDeleted = $carrierServer->hasBeenDeleted();
        if (!$isDeleted && !$isNew) {
            return;
        }

        /** @var OutgoingRoutingInterface[] $outgoingRoutings */
        $outgoingRoutings = $carrierServer->getCarrier()->getOutgoingRoutings();

        foreach ($outgoingRoutings as $outgoingRouting) {
            $this->lcrRuleTargetFactory->execute($outgoingRouting);
        }
    }
}
