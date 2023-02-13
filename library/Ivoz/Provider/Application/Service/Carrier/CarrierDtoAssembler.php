<?php

namespace Ivoz\Provider\Application\Service\Carrier;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Application\Service\CarrierServer\GetStatusFromLcrGatewayInfo;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServer;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerRepository;
use Ivoz\Provider\Domain\Model\Carrier\CarrierStatus;

class CarrierDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private CarrierServerRepository $carrierServerRepository,
        private GetStatusFromLcrGatewayInfo $statusFromLcrGatewayInfo,
    ) {
    }

    public function toDto(
        EntityInterface $entity,
        int $depth = 0,
        string $context = null
    ): DataTransferObjectInterface {
        Assertion::isInstanceOf(
            $entity,
            CarrierInterface::class
        );

        $carrierDto = $entity->toDto($depth);

        $carrierServers = $this
            ->carrierServerRepository
            ->findByCarrierId(
                (int)$entity->getId()
            );

        $carrierDto->addStatus(
            new CarrierStatus(
                count($carrierServers) > 0
            )
        );

        foreach ($carrierServers as $carrierServer) {
            $status = $this->statusFromLcrGatewayInfo->execute(
                $carrierServer->toDto()
            );

            if ($status !== 0) {
                $carrierDto->addStatus(
                    new CarrierStatus(
                        false
                    )
                );
                break;
            }
        }

        return $carrierDto;
    }
}
