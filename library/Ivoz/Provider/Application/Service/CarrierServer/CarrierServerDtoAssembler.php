<?php

namespace Ivoz\Provider\Application\Service\CarrierServer;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerDto;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerStatus;

class CarrierServerDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private GetStatusFromLcrGatewayInfo $statusFromLcrGatewayInfo
    ) {
    }

    public function toDto(
        EntityInterface $entity,
        int $depth = 0,
        string $context = null
    ): DataTransferObjectInterface {
        Assertion::isInstanceOf(
            $entity,
            CarrierServerInterface::class
        );

        $carrierServerDto = $entity->toDto($depth);

        $showStatus =
            $context === CarrierServerDto::CONTEXT_STATUS ||
            $context === CarrierServerDto::CONTEXT_COLLECTION;

        if (!$showStatus) {
            return $carrierServerDto;
        }

        $status = $this
            ->statusFromLcrGatewayInfo
            ->execute($carrierServerDto);

        if (is_null($status)) {
            $carrierServerDto->addStatus(
                new CarrierServerStatus(
                    false
                )
            );

            return $carrierServerDto;
        }

         $carrierServerDto->addStatus(
             new CarrierServerStatus(
                 $status === 0
             )
         );

        return $carrierServerDto;
    }
}
