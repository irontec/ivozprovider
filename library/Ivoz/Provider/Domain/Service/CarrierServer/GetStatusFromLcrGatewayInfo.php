<?php

namespace Ivoz\Provider\Domain\Service\CarrierServer;

use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Kam\Infrastructure\Persistence\Doctrine\TrunksLcrGatewayDoctrineRepository;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerDto;

class GetStatusFromLcrGatewayInfo
{
    public function __construct(
        private TrunksLcrGatewayDoctrineRepository $trunksLcrGatewayDoctrineRepository,
        private TrunksClientInterface $trunksClient
    ) {
    }

    public function execute(
        CarrierServerDto $carrierServerDto
    ): null|int {

        $carrierServerId = $carrierServerDto->getId();
        if (is_null($carrierServerId)) {
            return null;
        }

        $kamTrunksLcrGateway = $this
            ->trunksLcrGatewayDoctrineRepository
            ->findByCarrierServerId($carrierServerId);

        if (is_null($kamTrunksLcrGateway)) {
            return null;
        }

        try {
            $lcrGatewayInfo = $this->trunksClient->getLcrGatewayInfo(
                $kamTrunksLcrGateway->getId()
            );
        } catch (\Exception $e) {
            return null;
        }

        return $lcrGatewayInfo['state'] ?? null;
    }
}
