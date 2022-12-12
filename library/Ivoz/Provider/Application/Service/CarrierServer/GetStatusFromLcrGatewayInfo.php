<?php

namespace Ivoz\Provider\Application\Service\CarrierServer;

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

        if (is_null($carrierServerDto->getId())) {
            return null;
        }

        /** @var ?TrunksLcrGatewayInterface $kamTrunksLcrGateway */
        $kamTrunksLcrGateway = $this
            ->trunksLcrGatewayDoctrineRepository
            ->find(
                $carrierServerDto
                    ->getId()
            );

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
