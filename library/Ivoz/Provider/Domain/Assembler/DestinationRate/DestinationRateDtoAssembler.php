<?php

namespace Ivoz\Provider\Domain\Assembler\DestinationRate;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;

class DestinationRateDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct()
    {
    }

    /**
     * @param DestinationRateInterface $entity
     * @throws \Exception
     */
    public function toDto(EntityInterface $entity, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($entity, DestinationRateInterface::class);

        $dto = $entity->toDto($depth);

        $currencySymbol = $entity
            ->getDestinationRateGroup()
            ->getCurrencySymbol();

        $dto->setCurrencySymbol(
            $currencySymbol
        );

        return $dto;
    }
}
