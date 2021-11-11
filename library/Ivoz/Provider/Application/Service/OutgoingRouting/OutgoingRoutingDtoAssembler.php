<?php

namespace Ivoz\Provider\Application\Service\OutgoingRouting;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
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

        if (in_array($context, OutgoingRoutingDto::CONTEXTS_WITH_CARRIERS, true)) {
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
        }

        return $dto;
    }
}
