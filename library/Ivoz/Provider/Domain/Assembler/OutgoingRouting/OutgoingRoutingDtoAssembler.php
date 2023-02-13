<?php

namespace Ivoz\Provider\Domain\Assembler\OutgoingRouting;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrier;

class OutgoingRoutingDtoAssembler implements CustomDtoAssemblerInterface
{
    /**
     * @param OutgoingRoutingInterface $entity
     * @throws \Exception
     */
    public function toDto(EntityInterface $entity, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($entity, OutgoingRoutingInterface::class);

        $dto = $entity->toDto($depth);

        $carrierIds = array_map(
            function (OutgoingRoutingRelCarrier $relFeature) {
                return (int) $relFeature
                    ->getCarrier()
                    ->getId();
            },
            $entity->getRelCarriers()
        );

        $dto->setCarrierIds(
            $carrierIds
        );

        return $dto;
    }
}
