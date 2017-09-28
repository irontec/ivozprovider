<?php
namespace Ivoz\Provider\Domain\Service\PeerServer;

use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;
use Ivoz\Provider\Domain\Service\LcrGateway\CreateByOutgoingRouting;
use \Ivoz\Provider\Domain\Service\OutgoingRouting\UpdateLcrEntities as OutgoingRoutingUpdateLcrEntities;

/**
 * Class UpdateLcrEntities
 * @package Ivoz\Provider\Domain\Service\PeerServer
 * @lifecycle post_persist
 */
class UpdateLcrEntities implements PeerServerLifecycleEventHandlerInterface
{
    /**
     * @var UpdateLcrEntities
     */
    protected $updateLcrEntitiesByOutgoingRouting;

    /**
     * @var CreateByOutgoingRouting
     */
    protected $createLcrGatewayByOutgoingRouting;

    public function __construct(
        OutgoingRoutingUpdateLcrEntities $updateLcrEntitiesByOutgoingRouting
    ) {
        $this->updateLcrEntitiesByOutgoingRouting = $updateLcrEntitiesByOutgoingRouting;
    }

    public function execute(PeerServerInterface $entity, $isNew)
    {
        if (!$isNew) {
            return;
        }

        $outgoingRoutings = $entity
            ->getPeeringContract()
            ->getOutgoingRoutings();

        foreach ($outgoingRoutings as $outgoingRouting) {
            $this->updateLcrEntitiesByOutgoingRouting->execute($outgoingRouting);
        }
    }
}