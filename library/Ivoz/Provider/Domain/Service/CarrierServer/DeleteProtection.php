<?php

namespace Ivoz\Provider\Domain\Service\CarrierServer;

use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerRepository;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingRepository;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierRepository;

class DeleteProtection implements CarrierServerLifecycleEventHandlerInterface
{
    public const PRE_REMOVE_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private CarrierServerRepository $carrierServerRepository,
        private OutgoingRoutingRepository $outgoingRoutingRepository,
        private OutgoingRoutingRelCarrierRepository $outgoingRoutingRelCarrierRepository
    ) {
    }

    /**
     * @return array<string, int>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_PRE_REMOVE => self::PRE_REMOVE_PRIORITY
        ];
    }

    public function execute(CarrierServerInterface $carrierServer): void
    {
        $carrier = $carrierServer->getCarrier();
        $carrierId = $carrier->getId();

        if (!$carrierId) {
            return;
        }

        $isCarrierInUse = $this->isCarrierInUse($carrierId);

        if (!$isCarrierInUse) {
            return;
        }

        $carrierServers = $this->carrierServerRepository->findByCarrierId($carrierId);
        $isLastCarrierServer = count($carrierServers) === 1;
        if ($isLastCarrierServer) {
            throw new \DomainException(
                'Cannot delete the last CarrierServer from a Carrier that is being used in outgoing routes. ' .
                'At least one CarrierServer must remain.',
                403
            );
        }
    }

    private function isCarrierInUse(int $carrierId): bool
    {
        $staticRoutes = $this->outgoingRoutingRepository->findByCarrier($carrierId);

        if (!empty($staticRoutes)) {
            return true;
        }

        $lcrRoutes = $this->outgoingRoutingRelCarrierRepository->findByCarrier($carrierId);

        return !empty($lcrRoutes);
    }
}
