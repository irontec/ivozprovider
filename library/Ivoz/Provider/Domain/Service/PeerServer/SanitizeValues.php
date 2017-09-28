<?php

namespace Ivoz\Provider\Domain\Service\PeerServer;

use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\PeerServer
 * @lifecycle pre_persist
 */
class SanitizeValues implements PeerServerLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(PeerServerInterface $entity, $isNew)
    {
        $isNotNewAndPeeringContractHasChanged = !$isNew && $entity->hasChanged('peeringContractId');

        if ($isNotNewAndPeeringContractHasChanged || !$entity->getBrand()->getId()) {

            $peerContract = $entity->getPeeringContract();
            if (!$peerContract) {
                throw new \Exception('Unknown PeeringContract');
            }

            $brand = $peerContract->getBrand();
            if (!$brand) {
                throw new \Exception('Unknown Brand');
            }

            $entity->setBrand($brand);
        }

        if ($entity->getAuthNeeded() === 'no') {
            $entity->setAuthUser(null);
            $entity->setAuthPassword(null);
        }
    }
}